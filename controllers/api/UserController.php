<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */

use app\components\UploadFile;
use yii\base\Security;
use app\models\User;
use app\models\Otp;
use app\models\MarketingDataUser;
use Dompdf\Exception;
use Yii;
use yii\web\UploadedFile;
use app\components\Constant;
use app\components\SSOToken;
use app\models\Toko;
use yii\web\HttpException;

class UserController extends \yii\rest\ActiveController
{

    use UploadFile;
    public $modelClass = 'app\models\User';
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "only" => ["update-profile","get-toko","logout"],
        ];

        return $parent;
    }
    protected function verbs()
    {
        return [
            'login' => ['POST'],
            'register' => ['POST'],
            'refresh' => ['POST'],
            'update-profile' => ['POST'],
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        return $actions;
    }

    public function actionLogin()
    {
        $email = !empty($_POST['email']) ? $_POST['email'] : '';
        $password = !empty($_POST['password']) ? $_POST['password'] : '';
        $result = [];
        // validasi jika kosong
        if (empty($email) || empty($password)) {
            $result = [
                'status' => 'error',
                'message' => 'Email & password tidak boleh kosong!',
                'data' => ["email" => $email, "password" => $password],
            ];
        } else {
            try {
                $user = User::findOne([
                    "email" => $email,
                    // "password" => $this->validatePassword($user->password,$_POST['password']),
                ]);
                if (isset($user)) {
                    if ($user->validatePassword($password)) {
                    $generate_random_string = SSOToken::generateToken();
                    $user->secret_token = $generate_random_string;
                    $user->refresh_token = Yii::$app->security->generateRandomString();
                    $user->save();
                    
                    $result['success'] = true;
                    $result['message'] = "success login";
                    unset($user->password); // remove password from response
                    $result["data"] = $user;
                       
                    } else {
                        $result["success"] = false;
                        $result["message"] = "password salah";
                        $result["data"] = null;
                    }
                } else {
                    $result["success"] = false;
                    $result["message"] = "email tidak ada";
                    $result["data"] = null;
                }
            } catch (\Exception $e) {
                $result["success"] = false;
                $result["message"] = "email atau password salah";
                $result["data"] = $e->getMessage();
            }
        }

        return $result;
    }
    public function actionRefresh(){
        $user= User::findOne(['refresh_token'=>$_POST['refresh_token']]);
        if(!isset($user)){
            return [
                "success" => false,
                "message" => "Data Tidak DItemukan",
                "data" => []
            ];
        }
        $user->refresh_token = Yii::$app->security->generateRandomString();
        if($user->save()){
            return [
                "success" => true,
                "message" => "OK",
                "data" => (object)[
                    "secret_token" => $user->secret_token,
                    "refresh_token" => $user->refresh_token
                ]
            ];
        }
    }
    public function actionRegister()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $user = new User();
        // $user->name = $val['name'];
        $user->name = $val['name'];
        $user->email = $val['email'];
        $user->password = Yii::$app->security->generatePasswordHash($val['confirm_password']);
        $user->alamat = $val['alamat'];
        $user->kota = $val['kota'];
        $user->provinsi = $val['provinsi'];
        $user->type = $val['type'];
        $user->no_hp = $val['no_hp'] ?? '';
        $user->codepos = $val['codepos'];
        $user->role_id = 1;
        $user->status = 10;
        $user->created_at = date('Y-m-d H:i:s');
        // $user->img = 'default.png';

        if ($val['confirm_password'] != $val['password']) {
            return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
        }
        if ($user->email == '') {
            return ['success' => false, 'message' => 'gagal', 'data' => 'Email tidak boleh kosong'];
        }

        if (strlen($val['password']) < 3) {
            return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
        }
        if($user->no_hp != null){
            $check = User::findOne(['no_hp' => $val['no_hp']]);
            if ($check != null) {
                return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
            }
        }

        $check2 = User::findOne(['email' => $user->email]);
        if ($check2) {
            return ['success' => false, 'message' => 'gagal', 'data' => 'Email telah digunakan'];
        }

        if ($user->validate()) {
            $user->save();
            unset($user->password);
            return ['success' => true, 'message' => 'success', 'data' => $user];
        } else {
            // $user->rollback();
            return ['success' => false, 'message' => 'gagal', 'data' => $user->getErrors()];
        }
    }
    public function actionUpdateProfile()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $user = User::findOne([
            'id' => \Yii::$app->user->identity->id
        ]);
        $old = $user->password;
        $old_phone = $user->no_hp;
        $old_name = $user->name;
        // $new = Yii::$app->security->generatePasswordHash($val['old_password']);
        $password = $val['old_password'];
        if($password != null){
            $p = $user->validatePassword($password);

        }
        // var_dump($old_name);die;
        $photo_url = $user->img;
        $image = UploadedFile::getInstanceByName("photo_url");
        if ($image) {
            $response = $this->uploadImage($image, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $user->img = $response->filename;
        } else {
            $user->img = $photo_url;
        }
        if($val['name'] == null){
            $user->name = $old_name;
        }else{
            $user->name = $val['name'];
        }
        // var_dump($user->name);die;
        if($val['confirm_password'] == null && $val['new_password'] == null && $password == null){
            $user->password = $old;
        }else{
            $user->password = Yii::$app->security->generatePasswordHash($val['confirm_password']);

        }
        // $user->name = $val['name'];
        if($val['no_hp'] != null){
            $check = User::findOne(['no_hp' => $val['no_hp']]);
            if ($check != null) {
            return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
        }
            $user->no_hp = $val['no_hp'];

        }else{
            
            $user->no_hp = $old_phone;
        }
        // $user->address = $val['address'];
        
        if($val['confirm_password'] != null || $val['new_password'] != null){
            if($p == false){

                return ['success' => false, 'message' => 'Password lama yang anda masukkan tidak sama', 'data' => null];
            }
            if ($val['confirm_password'] != $val['new_password']) {
                return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
            }
            if (strlen($val['new_password']) < 3 || strlen($val['confirm_password']) < 3) {
                return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
            }
        }
        if ($user->validate()) {
            $user->save();
            
            return ['success' => true, 'message' => 'Berhasil Update  Profile', 'data' => $user];
        } else {
            return ['success' => false, 'message' => 'Gagal Update Profile', 'data' => $user->getErrors()];
        }
    }
    public function actionLogout()
    {
        $user = Yii::$app->user->id;
        $model = User::findOne($user);
        var_dump($model);die;
        if($model == null){
            return [
                'success' => false,
                'message' => 'User not found',
            ];
        }
        $model->refresh_token = null;
        $model->secret_token = null;
        $model->save();
        return (object) [
            "success" => true,
            "message" => "Berhasil logout",
        ];
    }
    public function actionGetToko(){

        $model = Yii::$app->user->id;
        $user = User::findOne($model);
        if(!isset($user)){
            return [
                "success" => false,
                "message" => "Data Tidak DItemukan",
                "data" => []
            ];
        }
        $toko = Toko::findOne(['id_user'=>$user->id]);
        if(!isset($toko)){
            return [
                "success" => false,
                "message" => "Toko Tidak DItemukan",
                "data" => []
            ];
        }
        return [
            "success" => true,
            "message" => "OK",
            "data" => $toko
        ];
    }
}
