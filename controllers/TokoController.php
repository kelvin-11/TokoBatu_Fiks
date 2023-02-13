<?php

namespace app\controllers;

use app\models\PesananDetail;
use app\models\Products;
use app\models\search\ProdukSayaSearch;
use Yii;
use yii\web\Controller;
use app\models\Toko;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\UploadedFile;

class TokoController extends Controller
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

    public function actionToko()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }
        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();

        return $this->render('sidemenu.toko', [
            'data' => $data
        ]);
    }
    public function actionRegisterToko()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id == 3) {
            Yii::$app->session->setFlash('error', 'Anda telah daftar menjadi penjual');
            return $this->goBack();
        }

        $data = User::find()->where(Yii::$app->user->identity->id)->andWhere(['role_id' => 1])->andWhere(['email' => Yii::$app->user->identity->email])->one();
        $model = new Toko();

        if ($model->load($_POST)) {
            $model->id_user = Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');

            $foto_banners = UploadedFile::getInstance($model, 'flag');
            if ($foto_banners != NULL) {
                # store the source foto_banners name
                $model->flag = $foto_banners->name;
                $arr = explode(".", $foto_banners->name);
                $extension = end($arr);

                # generate a unique foto_banners name
                $model->flag = Yii::$app->security->generateRandomString() . ".{$extension}";

                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->flag;
                $foto_banners->saveAs($path);
            }
            if ($model->validate()) {
                if ($model->save()) {
                    $data->role_id = 3;
                    $data->save();
                    $phone_sender = substr_replace($model->no_whatsapp, '62', 0, 1);
                    $pesan_sender = "Salam kak {$data->name}, ini adalah pesan otomatis dari Toko Batu.
Kami ucapkan terima kasih karena telah mendaftar sebagai penjual di toko kami dan tolong bantu kami dengan memberi bintang 5.
                    
Kirimkan Rating kepada Toko Kami pada link diberikut. ...

Terimakasih telah menggunakan layanan Toko Batu";
                    $this->Send($phone_sender, $pesan_sender);

                    Yii::$app->session->setFlash("success", "Pendaftaran Toko berhasil");
                    return $this->redirect(["beranda-toko"]);
                }
            } else {
                Yii::$app->session->setFlash("error", "Pendaftaran gagal. Validasi data tidak valid ");
                return $this->redirect('toko/register-toko');
            }
        } elseif (!\Yii::$app->request->isPost) {
            $model->load($_GET);
        }

        return $this->render('register-toko', [
            'data' => $data,
            'model' => $model,
        ]);
    }

    protected function Send($no_wa, $content, $img = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://wa-api.ptpromedia.co.id:8178/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('number' => $no_wa, 'message' => $content, 'tokens' => 'UFQuIFByb21lZGlhIENpdHJhIEluZm9ybWF0aW5kbw=='),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function actionBerandaToko()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
        $produk = Products::find()->where(['toko_id' => $data->id])->count();

        $terjual = Products::find()
            ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
            ->where(['toko_id' => $data->id])
            ->sum('pesanan_detail.jml');

        $pendapatan = Products::find()
            ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
            ->where(['toko_id' => $data->id])
            ->sum('pesanan_detail.total');

        // $chart = Yii::$app->db->createCommand("select month(pesanan.created_at) as bulan, sum(pesanan_detail.jml) as jml_pesanan from pesanan 
        //     inner join pesanan_detail on pesanan.id =pesanan_detail.pesanan_id 
        //     inner join products on products.id=pesanan_detail.products_id
        //     where year(pesanan.created_at) =:tahun
        //     and toko_id=:idToko
        //     group by month(pesanan.created_at)", [
        //     'idToko' => Yii::$app->user->identity->tokos[0]->id,
        //     'tahun' => 2023
        // ])->queryAll();

        return $this->render('beranda-toko', [
            'identy' => $identy,
            'data' => $data,
            'produk' => $produk,
            'terjual' => $terjual,
            'pendapatan' => $pendapatan,
            // 'chart' => $chart
        ]);
    }

    public function actionTokoProduk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $searchModel  = new ProdukSayaSearch();
        $dataProvider = $searchModel->search($_GET);
        $dataProvider->pagination = ['pageSize' => 3];

        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();

        return $this->render('toko-produk', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'data' => $data,
        ]);
    }

    public function actionPengaturanToko()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
        $model = Toko::find()->where(['id_user' => Yii::$app->user->identity->id])->one();

        $oldBanner = $model->flag;
        if ($model->load($_POST)) {
            $model->updated_at = date('y-m-d H:i:s');

            $flag = UploadedFile::getInstance($model, 'flag');
            if ($flag != NULL) {
                $model->flag = $flag->name;
                $arr = explode(".", $flag->name);
                $extension = end($arr);

                $model->flag = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->flag;
                if ($oldBanner != NULL) {

                    $flag->saveAs($path);
                } else {
                    $flag->saveAs($path);
                }
            } else {
                $model->flag = $oldBanner;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data Toko berhasil di rubah');
                return $this->redirect('beranda-toko');
            }
        }
        return $this->render('pengaturan-toko', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    public function actionCreateProduk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
        $model = new Products();

        if ($model->load($_POST)) {
            $toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);
            $model->toko_id = $toko->id;
            $model->user_id = Yii::$app->user->identity->id;

            $foto_banners = UploadedFile::getInstance($model, 'img');
            if ($foto_banners != NULL) {
                # store the source foto_banners name
                $model->img = $foto_banners->name;
                $arr = explode(".", $foto_banners->name);
                $extension = end($arr);

                # generate a unique foto_banners name
                $model->img = Yii::$app->security->generateRandomString() . ".{$extension}";

                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->img;
                $foto_banners->saveAs($path);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Produk berhasil dibuat");
                return $this->redirect(['toko-produk', 'id' => $model->id]);
            }
        } elseif (!\Yii::$app->request->isPost) {
            $model->load($_GET);
        }

        return $this->render('create-produk', [
            'data' => $data,
            'model' => $model
        ]);
    }

    public function actionViewProduk($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $model = Products::findOne(['id' => $id]);
        return $this->render('view-produk', [
            'model' => $model,
        ]);
    }

    public function actionEditProduk($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 3) {
            return $this->goHome();
        }

        $data = Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
        $model = Products::findOne(['id' => $id]);

        $oldBanner = $model->img;
        if ($model->load($_POST)) {
            $img = UploadedFile::getInstance($model, 'img');
            if ($img != NULL) {
                # store the source file name
                $model->img = $img->name;
                $arr = explode(".", $img->name);
                $extension = end($arr);

                # generate a unique file name
                $model->img = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->img;
                if ($oldBanner != NULL) {
                    $img->saveAs($path);
                } else {
                    $img->saveAs($path);
                }
            } else {
                $model->img = $oldBanner;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil di rubah');
                return $this->redirect('toko-produk');
            }
        }
        return $this->render('edit-produk', [
            'data' => $data,
            'model' => $model,
        ]);
    }

    public function actionDeleteProduk($id)
    {
        try {
            Products::findOne(['id' => $id])->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect('toko-produk');
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            Yii::$app->session->setFlash('success', 'Data berhasil di hapus');
            return $this->redirect(['toko-produk']);
        }
    }

    public function actionIndex()
    {
        if (isset($_GET['toko'])) {
            $toko = $_GET['toko'];
            $model = Toko::find()->where(['name' => $toko])->one();
            $coba = Products::find()->where(['toko_id' => $model->id]);
            $count = $coba->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
            $query = $coba->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        return $this->render('index', [
            'pagination' => $pagination,
            'model' => $model,
            'query' => $query
        ]);
    }
}
