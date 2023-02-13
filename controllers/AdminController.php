<?php

namespace app\controllers;

use app\models\Category;
use app\models\JasaKirim;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\Products;
use app\models\Toko;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;

class AdminController extends Controller
{
    //untuk membuat layouts baru
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->layout = '@app/views/layouts-admin/main';
        return parent::beforeAction($action);
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }

        $customercount = User::find()->where(['role_id' => 1])->count();
        $c = User::find()->where(['role_id' => 1]);
        $count = $c->count();
        $pagecustomer = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $customer = $c->offset($pagecustomer->offset)
            ->limit($pagecustomer->limit)
            ->all();

        $salercount = Toko::find()->count();
        $s = Toko::find();
        $count = $s->count();
        $pagesaler = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $saler = $s->offset($pagesaler->offset)
            ->limit($pagesaler->limit)
            ->all();

        $produkcount = Products::find()->count();
        $p = Products::find();
        $count = $p->count();
        $pageproduk = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $produk = $p->offset($pageproduk->offset)
            ->limit($pageproduk->limit)
            ->all();

        $jasacount = JasaKirim::find()->count();
        $j = JasaKirim::find();
        $count = $j->count();
        $pagejasa = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $jasa = $j->offset($pagejasa->offset)
            ->limit($pagejasa->limit)
            ->all();

        $categorycount = Category::find()->count();
        $c = Category::find();
        $count = $c->count();
        $pagecategory = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $category = $c->offset($pagecategory->offset)
            ->limit($pagecategory->limit)
            ->all();

        $pesanancount = pesanan::find()->where(['status' => 1])->count();
        $p = pesanan::find()->where(['status' => 1]);
        $count = $p->count();
        $pagepesanan = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $pesanan = $p->offset($pagepesanan->offset)
            ->limit($pagepesanan->limit)
            ->all();

        return $this->render('index', [
            'pagecustomer' => $pagecustomer,
            'pagesaler' => $pagesaler,
            'pageproduk' => $pageproduk,
            'pagejasa' => $pagejasa,
            'pagecategory' => $pagecategory,
            'pagepesanan' => $pagepesanan,

            'customercount' => $customercount,
            'salercount' => $salercount,
            'produkcount' => $produkcount,
            'jasacount' => $jasacount,
            'categorycount' => $categorycount,
            'pesanancount' => $pesanancount,

            'customer' => $customer,
            'saler' => $saler,
            'produk' => $produk,
            'jasa' => $jasa,
            'category' => $category,
            'pesanan' => $pesanan,
        ]);
    }

    //Produk =====================================================================================
    public function actionProduk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $category = Category::find()->all();
        $identy = Yii::$app->user->identity;
        $data = Products::find()->where(['user_id' => $identy->id]);
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('produk\produk', [
            'model' => $model,
            'pagination' => $pagination,
            'category' => $category
        ]);
    }

    public function actionBuatProduk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = new Products();

        if ($model->load($_POST)) {
            $model->user_id = Yii::$app->user->identity->id;

            $gambar = UploadedFile::getInstance($model, 'img');
            if ($gambar != NULL) {
                $model->img = $gambar->name;
                $arr = explode(".", $gambar->name);
                $extension = end($arr);

                $model->img = Yii::$app->security->generateRandomString() . ".{$extension}";

                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->img;
                $gambar->saveAs($path);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash("success", "Produk berhasil dibuat");
                return $this->redirect(['produk', 'id' => $model->id]);
            }
        } elseif (!\Yii::$app->request->isPost) {
            $model->load($_GET);
        }

        return $this->render('produk\buat-produk', [
            'model' => $model
        ]);
    }

    public function actionUpdateProduk($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = Products::findOne($id);

        $gambar = $model->img;
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
                if ($gambar != NULL) {
                    $img->saveAs($path);
                } else {
                    $img->saveAs($path);
                }
            } else {
                $model->img = $gambar;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil di rubah');
                return $this->redirect('produk');
            }
        }
        return $this->render('produk\edit-produk', [
            'model' => $model,
        ]);
    }

    public function actionDeleteProduk($id)
    {
        Products::findOne(['id' => $id])->delete();

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
            return $this->redirect(['produk']);
        }
    }

    //Category ===============================================================================================
    public function actionCategory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = Category::find();
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('produk\category', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionBuatCategory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = new Category();

        $gambar = $model->img;
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
                if ($gambar != NULL) {
                    $img->saveAs($path);
                } else {
                    $img->saveAs($path);
                }
            } else {
                $model->img = $gambar;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data Category berhasil di Buat');
                return $this->redirect(['category', 'id' => $model->id]);
            }
        }
        return $this->render('produk\buat-category', [
            'model' => $model,
        ]);
    }

    public function actionUpdateCategory($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }
        
        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = Category::findOne($id);

        $gambar = $model->img;
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
                if ($gambar != NULL) {
                    $img->saveAs($path);
                } else {
                    $img->saveAs($path);
                }
            } else {
                $model->img = $gambar;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil di rubah');
                return $this->redirect('category');
            }
        }
        return $this->render('produk\edit-category', [
            'model' => $model,
        ]);
    }

    public function actionDeleteCategory($id)
    {
        Category::findOne(['id' => $id])->delete();

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
            return $this->redirect(['category']);
        }
    }

    //Jasa Kirim =============================================================================================================
    public function actionJasa()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = JasaKirim::find();
        $count = $data->count();
        $pagination =  new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('jasa\index', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionBuatJasa()
    {
        $val = Yii::$app->request->post();
        $model = new JasaKirim();

        if ($model) {
            $model->name = $val['name'];
            $model->slug = $val['slug'];
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Data Berhasil Di Buat');
                return $this->redirect('jasa');
            } else {
                Yii::$app->session->setFlash('error', 'Validasi tidak valid, dimohon untuk membuat ulang data!');
                return $this->redirect('jasa');
            }
        }
    }

    public function actionUpdateJasa()
    {
        $val = Yii::$app->request->post();
        $model = JasaKirim::findOne(['id' => $val['id']]);

        if ($model) {
            $model->name = $val['name'];
            $model->slug = $val['slug'];
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Data Berhasil Di Buat');
                return $this->redirect('jasa');
            } else {
                Yii::$app->session->setFlash('error', 'Validasi tidak valid, dimohon untuk membuat ulang data!');
                return $this->redirect('jasa');
            }
        }
    }

    public function actionDeleteJasa($id)
    {
        JasaKirim::findOne(['id' => $id])->delete();

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
            return $this->redirect(['jasa']);
        }
    }

    //Penjualan ===============================================================================================================
    public function actionPenjualan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $jasa = JasaKirim::find()->all();
        $data = Pesanan::find()->where(['status' => 1]);
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('penjualan\semua-penjualan', [
            'model' => $model,
            'pagination' => $pagination,
            'jasa' => $jasa
        ]);
    }

    public function actionUpdatePenjualan()
    {
        $val = Yii::$app->request->post();
        $model = Pesanan::findOne(['id' => $val['id']]);

        if ($model) {
            $model->jasa_id = $val['jasa'];
            $model->status_pemesanan = $val['status_pemesanan'];
            $model->ongkir = $val['ongkir'];
            $model->total_harga = $val['harga'];
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Data Penjualan berhasil di rubah');
                return $this->redirect('penjualan');
            } else {
                Yii::$app->session->setFlash('error', 'Ada yang salah');
                return $this->redirect('penjualan');
            }
        }
    }

    public function actionDeletePenjualan($id)
    {
        Pesanan::findOne(['id' => $id])->delete();

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
            return $this->redirect(['penjualan']);
        }
    }

    //Customer ==============================================================================================
    public function actionCustomer()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = User::find()->where(['role_id' => 1]);
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('customer\customer-list', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionDeleteCustomer($id)
    {
        User::findOne(['id' => $id])->delete();

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
            return $this->redirect(['customer']);
        }
    }

    //Penjual ====================================================================================================================
    public function actionPenjual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = Toko::find();
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('penjual\index', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionDeletePenjual($id)
    {
        $model = Toko::findOne($id);

        if ($model) {
            $user = User::findOne(['id' => $model->id_user]);
            if ($user) {
                $user->role_id = 1;
                if ($user->validate()) {
                    $user->save();
                } else {
                    Yii::$app->session->setFlash('error', 'Gagal memproses data');
                }
            }
            $model->delete();
            Yii::$app->session->setFlash('success', 'Data berhasil di hapus');
            return $this->redirect('penjual');
        }
    }

    //Laporan ============================================================================================
    public function actionProdukPenjual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }

        $data = Toko::find();
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $model = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('laporan\produk-penjual', [
            'model' => $model,
            'pagination' => $pagination
        ]);
    }

    public function actionStokProduk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = Products::find()->with('category');
        if (isset($_GET['Products'])) {
            $search_args = \Yii::$app->request->get()['Products'];
            $data->andFilterWhere([
                'category_id' => $search_args['category_id']
            ]);
        }
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $produk = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('laporan\stok-produk', [
            'produk' => $produk,
            'pagination' => $pagination
        ]);
    }

    public function actionJumlahPenjualan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }


        $data = Products::find()->with('category');
        if (isset($_GET['Products'])) {
            $search_args = \Yii::$app->request->get()['Products'];
            $data->andFilterWhere([
                'category_id' => $search_args['category_id']
            ]);
        }
        $count = $data->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $produk = $data->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('laporan\jumlah-penjualan', [
            'produk' => $produk,
            'pagination' => $pagination,
        ]);
    }
}
