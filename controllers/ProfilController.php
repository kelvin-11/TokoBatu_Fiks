<?php

namespace app\controllers;

use app\models\Favorit;
use Yii;
use yii\web\Controller;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\User;
use yii\data\Pagination;
use yii\web\UploadedFile;

class ProfilController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->layout = '@app/views/layouts-profil/main';
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionProfil()
    {
        if (yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $model = User::find()->where(['id' => Yii::$app->user->identity])->one();
        $history = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->count();
        $favorit = Favorit::find()->where(['user_id' => $model->id])->count();

        $pesanan = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 0])->one();
        if ($pesanan != null) {
            $keranjang = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
            return $this->render('profil', [
                'model' => $model,
                'pesanan' => $pesanan,
                'keranjang' => $keranjang,
                'history' => $history,
                'favorit' => $favorit,
            ]);
        }

        return $this->render('profil', [
            'model' => $model,
            'pesanan' => $pesanan,
            'history' => $history,
            'favorit' => $favorit,
        ]);
    }

    public function actionEditProfil()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = yii::$app->user->identity;
        $model = User::find()->where(["id" => Yii::$app->user->id])->one();

        $oldPhotoUrl = $model->img;
        if ($model->load($_POST)) {
            $model->no_hp = $model->no_hp;
            $model->alamat = $model->alamat;
            $model->updated_at = date('Y-m-d H:i:s');

            $image = UploadedFile::getInstance($model, 'img');
            if ($image != NULL) {
                # store the source file name
                $model->img = $image->name;
                $arr = explode(".", $image->name);
                $extension = end($arr);

                # generate a unique file name
                $model->img = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->img;
                if ($oldPhotoUrl != NULL) {
                    $image->saveAs($path);
                } else {
                    $image->saveAs($path);
                }
            } else {
                $model->img = $oldPhotoUrl;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Profile berhasil diubah");
            } else {
                Yii::$app->session->setFlash("error", "Profile gagal diubah");
            }
            return $this->redirect('profil');
        }

        return $this->render('edit-profil', [
            'model' => $model,
            'identy' => $identy
        ]);
    }

    public function actionHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $model = User::findOne(['id' => Yii::$app->user->identity]);
        $pesanans = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('history', [
            'model' => $model,
            'pesanans' => $pesanans,
        ]);
    }

    public function actionFavorit()
    {
        $favorit = Favorit::find()->where(['user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('favorit', [
            'favorit' => $favorit,
        ]);
    }

    public function actionDeleteFavorit($id)
    {
        $data = Favorit::findOne($id);
        if ($data) {
            $data->delete();
            Yii::$app->session->setFlash('success', 'Data berhasil dihapus');
            return $this->redirect('favorit');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menghapus data');
            return $this->redirect('favorit');
        }
    }
}
