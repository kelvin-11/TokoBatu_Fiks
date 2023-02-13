<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\User;
use yii\data\Pagination;
use yii\web\UploadedFile;

class ProfilController extends Controller
{
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
    public function actionSideMenu()
    {
        $model = User::find()->where(['id' => Yii::$app->user->identity])->one();
        $identy = Yii::$app->user->identity;

        return $this->render('sidemenu.profil', [
            'model' => $model,
            'identy' => $identy
        ]);
    }

    public function actionProfil()
    {
        if (yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $model = User::find()->where(['id' => Yii::$app->user->identity])->one();
        $identy = Yii::$app->user->identity;
        $history = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->count();
        $berhasil = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->andWhere(['status_pemesanan' => 'sukses'])->count();
        $pending = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 0])->andWhere(['status_pemesanan' => 'pending'])->count();
        $dikonfirmasi = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->andWhere(['status_pemesanan' => 'dikonfirmasi'])->count();
        $dalamperjalanan = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->andWhere(['status_pemesanan' => 'dalam perjalanan'])->count();
        $gagal = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1])->andWhere(['status_pemesanan' => 'gagal'])->count();

        $pesanan = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 0])->one();
        if ($pesanan != null) {
            $keranjang = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
            return $this->render('profil', [
                'model' => $model,
                'identy' => $identy,
                'pesanan' => $pesanan,
                'keranjang' => $keranjang,
                'history' => $history,
                'berhasil' => $berhasil,
                'pending' => $pending,
                'dikonfirmasi' => $dikonfirmasi,
                'dalamperjalanan' => $dalamperjalanan,
                'gagal' => $gagal
            ]);
        }

        return $this->render('profil', [
            'model' => $model,
            'identy' => $identy,
            'pesanan' => $pesanan,
            'history' => $history,
            'berhasil' => $berhasil,
            'pending' => $pending,
            'dikonfirmasi' => $dikonfirmasi,
            'dalamperjalanan' => $dalamperjalanan,
            'gagal' => $gagal
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
            if ($model->save(false)) {
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

        $identy = Yii::$app->user->identity;

        $model = User::findOne(['id' => Yii::$app->user->identity]);
        $pesanan = Pesanan::find()->where(['user_id' => $model->id])->andWhere(['status' => 1]);
        $count = $pesanan->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
        $pesanans = $pesanan->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('history', [
            'model' => $model,
            'identy' => $identy,
            'pagination' => $pagination,
            'pesanans' => $pesanans,
        ]);
    }
}
