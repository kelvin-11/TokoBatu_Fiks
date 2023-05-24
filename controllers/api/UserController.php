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
use app\models\Products;
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
            "only" => ["update-profile", "get-toko", "logout", "register-toko", "pengaturan-toko", "create-produk", "edit-produk"],
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
            'register-toko' => ['POST'],
            'pengaturan-toko' => ['POST'],
            'create-produk' => ['POST'],
            'edit-produk' => ['POST'],
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
    public function actionRefresh()
    {
        $user = User::findOne(['refresh_token' => $_POST['refresh_token']]);
        if (!isset($user)) {
            return [
                "success" => false,
                "message" => "Data Tidak DItemukan",
                "data" => []
            ];
        }
        $user->refresh_token = Yii::$app->security->generateRandomString();
        if ($user->save()) {
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
        $user->name = $val['name'];
        $user->email = $val['email'];
        $user->password = Yii::$app->security->generatePasswordHash($val['password']);
        // $user->alamat = $val['alamat'];
        // $user->kota = $val['kota'];
        // $user->provinsi = $val['provinsi'];
        // $user->type = $val['type'];
        // $user->no_hp = $val['no_hp'] ?? '';
        // $user->codepos = $val['codepos'];
        // $user->img = 'default.png';
        $user->status = 10;
        $user->role_id = 1;
        $user->created_at = date('Y-m-d H:i:s');

        if ($user->password !== null) {
            $generate_random_string = SSOToken::generateToken();
            $user->secret_token = $generate_random_string;
            $user->refresh_token = Yii::$app->security->generateRandomString();
            $user->save();
        }

        // if ($val['confirm_password'] != $val['password']) {
        //     return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
        // }

        if ($user->email == '') {
            return ['success' => false, 'message' => 'gagal', 'data' => 'Email tidak boleh kosong'];
        }

        if (strlen($val['password']) < 3) {
            return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
        }

        // if ($user->no_hp != null) {
        //     $check = User::findOne(['no_hp' => $val['no_hp']]);
        //     if ($check != null) {
        //         return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
        //     }
        // }

        // $check2 = User::findOne(['email' => $user->email]);
        // if ($check2) {
        //     return ['success' => false, 'message' => 'gagal', 'data' => 'Email telah digunakan'];
        // }

        if ($user->validate()) {
            $user->save();
            unset($user->password);
            return ['success' => true, 'message' => 'success', 'data' => $user];
        } else {
            return ['success' => false, 'message' => 'gagal', 'data' => $user->getErrors()];
        }
    }

    public function actionUpdateProfile()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $user = User::findOne(['id' => \Yii::$app->user->identity->id]);
        // $old_password = $user->password;
        $old_name = $user->name;
        $old_alamat = $user->alamat;
        $old_phone = $user->no_hp;
        // $new = Yii::$app->security->generatePasswordHash($val['old_password']);
        // $password = $val['old_password'];
        // if ($password != null) {
        //     $p = $user->validatePassword($password);
        // }

        $photo_url = $user->img;
        $image = UploadedFile::getInstanceByName("photo_url");
        if ($image) {
            $response = $this->uploadFile($image, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $user->img = $response->filename;
        } else {
            $user->img = $photo_url;
        }

        if ($val['name'] == null) {
            $user->name = $old_name;
        } else {
            $user->name = $val['name'];
        }

        if ($val['alamat'] == null) {
            $user->alamat = $old_alamat;
        } else {
            $user->alamat = $val['alamat'];
        }

        // if ($val['confirm_password'] == null && $val['new_password'] == null && $password == null) {
        //     $user->password = $old_password;
        // } else {
        //     $user->password = Yii::$app->security->generatePasswordHash($val['confirm_password']);
        // }

        if ($val['no_hp'] != null) {
            // $check = User::findOne(['no_hp' => $val['no_hp']]);
            // if ($check != null) {
            //     return ['success' => false, 'message' => 'No Telp telah digunakan', 'data' => null];
            // }
            $user->no_hp = $val['no_hp'];
        } else {
            $user->no_hp = $old_phone;
        }

        // if ($val['confirm_password'] != null || $val['new_password'] != null) {
        //     if ($p == false) {
        //         return ['success' => false, 'message' => 'Password lama yang anda masukkan tidak sama', 'data' => null];
        //     }
        //     if ($val['confirm_password'] != $val['new_password']) {
        //         return ['success' => false, 'message' => 'Password tidak sama', 'data' => null];
        //     }
        //     if (strlen($val['new_password']) < 3 || strlen($val['confirm_password']) < 3) {
        //         return ['success' => false, 'message' => 'Password minimal 4 karakter', 'data' => null];
        //     }
        // }

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
        var_dump($model);
        die;
        if ($model == null) {
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
    public function actionGetToko()
    {
        $model = Yii::$app->user->id;
        $user = User::findOne($model);
        if (!isset($user)) {
            return [
                "success" => false,
                "message" => "Data Tidak DItemukan",
                "data" => [],

            ];
        }
        $toko = Toko::findOne(['id_user' => $user->id]);
        if (!isset($toko)) {
            return [
                "success" => false,
                "message" => "Toko Tidak DItemukan",
                "data" => [],

            ];
        }
        return [
            "success" => true,
            "message" => "OK",
            "data" => $toko,
        ];
    }
    public function actionRegisterToko()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        if (Yii::$app->user->identity->role_id == 3) {
            return [
                'success' => false,
                'message' => 'terdaftar',
                'data' => 'Anda Telah Daftar Menjadi Penjual'
            ];
        }

        $data = User::find()->where(['id' => Yii::$app->user->identity->id])->andWhere(['role_id' => 1])->andWhere(['email' => Yii::$app->user->identity->email])->one();
        $model = new Toko();

        $model->id_user = Yii::$app->user->identity->id;
        $model->name = $val['name'];
        $model->deskripsi = $val['deskripsi'];
        $model->alamat = $val['alamat'];
        $model->no_whatsapp = $val['no_whatsapp'];
        $model->created_at = date('y-m-d H:i:s');

        $flag = UploadedFile::getInstanceByName("flag");
        if ($flag) {
            $response = $this->uploadFile($flag, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $model->flag = $response->filename;
        }

        $check = Toko::findOne(['name' => $model->name]);
        if ($check) {
            return [
                'success' => false,
                'message' => 'gagal',
                'data' => 'Nama telah digunakan'
            ];
        }

        $check2 = Toko::findOne(['no_whatsapp' => $model->no_whatsapp]);
        if ($check2) {
            return [
                'success' => false,
                'message' => 'gagal',
                'data' => 'No Whatsapp telah digunakan',
            ];
        }

        if ($model->validate()) {
            if ($model->save()) {
                $data->role_id = 3;
                $data->save();
                return [
                    'success' => true,
                    'message' => 'Pendaftaran Toko Berhasil',
                    'data' => $model,
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Pendaftaran Gagal. Validasi data tidak valid',
                'data' => null
            ];
        }
    }

    public function actionPengaturanToko()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $toko = Toko::findOne(['id_user' => yii::$app->user->identity->id]);

        $old_name = $toko->name;
        $old_deskripsi = $toko->deskripsi;
        $old_alamat = $toko->alamat;
        $toko->updated_at = date('y-m-d H:i:s');

        $old_banner = $toko->flag;
        $banner = UploadedFile::getInstanceByName('flag');
        if ($banner) {
            $response = $this->uploadFile($banner, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $toko->flag = $response->filename;
        } else {
            $toko->flag = $old_banner;
        }

        if ($val['name'] == "null") {
            $toko->name = $old_name;
        } else {
            $toko->name = $val['name'];
        }

        if ($val['deskripsi'] == "null") {
            $toko->deskripsi = $old_deskripsi;
        } else {
            $toko->deskripsi = $val['deskripsi'];
        }

        if ($val['alamat'] == "null") {
            $toko->alamat = $old_alamat;
        } else {
            $toko->alamat = $val['alamat'];
        }

        $toko->no_whatsapp = $val['no_whatsapp'];

        if ($toko->validate()) {
            $toko->save();
            return [
                'success' => true,
                'message' => 'Berhasil update Toko',
                'data' => $toko,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Gagal update Toko',
                'data' => $toko->getErrors(),
            ];
        }
    }

    public function actionCreateProduk()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $toko = Toko::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $model = new Products();

        $img = UploadedFile::getInstanceByName("img");
        if ($img) {
            $response = $this->uploadFile($img, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar Gagal diunggah");
            }
            $model->img = $response->filename;
        }

        $model->name = $val['name'];
        $model->user_id = Yii::$app->user->identity->id;
        $model->category_id = $val['category_id'];
        $model->toko_id = $toko->id;
        $model->harga = $val['harga'];
        $model->stok = $val['stok'];
        $model->berat = $val['berat'];
        $model->deskripsi_produk = $val['deskripsi_produk'];

        if ($model->validate()) {
            $model->save();
            return [
                'success' => true,
                'message' => 'Produk berhasil dibuat',
                'data' => $model
            ];
        } else {
            return [
                'success' => false,
                'message' => 'gagal',
                'data' => null
            ];
        }
    }

    public function actionRemoveProduk($id)
    {
        $data = Products::findOne(['id' => $id]);
        if ($data) {
            $data->delete();
            return [
                'success' => true,
                'message' => 'Produk berhasil dihapus',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Produk gagal dihapus'
            ];
        }
    }

    public function actionEditProduk($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $val = \yii::$app->request->post();

        $toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);

        $model = Products::findOne(['id' => $id]);
        $model->toko_id = $toko->id;
        $model->user_id = Yii::$app->user->identity->id;

        $old_name = $model->name;
        $old_category = $model->category_id;
        $old_harga = $model->harga;
        $old_stok = $model->stok;
        $old_berat = $model->berat;
        $old_deskripsi = $model->deskripsi_produk;

        $old_image = $model->img;
        $image = UploadedFile::getInstanceByName("img");
        if ($image) {
            $response = $this->uploadFile($image, "user");
            if ($response->success == false) {
                throw new HttpException(419, "Gambar gagal diunggah");
            }
            $model->img = $response->filename;
        } else {
            $model->img = $old_image;
        }

        if ($val['name'] == 'null') {
            $model->name = $old_name;
        } else {
            $model->name = $val['name'];
        }

        if ($val['category_id'] == 'null') {
            $model->category_id = $old_category;
        } else {
            $model->category_id = $val['category_id'];
        }

        if ($val['harga'] == 'null') {
            $model->harga = $old_harga;
        } else {
            $model->harga = $val['harga'];
        }

        if ($val['stok'] == 'null') {
            $model->stok = $old_stok;
        } else {
            $model->stok = $val['stok'];
        }

        if ($val['berat'] == 'null') {
            $model->berat = $old_berat;
        } else {
            $model->berat = $val['berat'];
        }

        if ($val['deskripsi_produk'] == 'null') {
            $model->deskripsi_produk = $old_deskripsi;
        } else {
            $model->deskripsi_produk = $val['deskripsi_produk'];
        }

        if ($model->validate()) {
            $model->save();
            return [
                'success' => true,
                'message' => "Produk berhasil diEdit",
                'data' => $model,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Produk gagal diEdit',
                'data' => $model->getErrors(),
            ];
        }
    }
}
