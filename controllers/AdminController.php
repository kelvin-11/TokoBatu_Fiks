<?php

namespace app\controllers;

use app\models\Banner;
use app\models\Category;
use app\models\Favorit;
use app\models\JasaKirim;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\Products;
use app\models\Promo;
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
        $salercount = Toko::find()->count();
        $categorycount = Category::find()->count();
        $jasacount = JasaKirim::find()->count();


        return $this->render('index', [
            'customercount' => $customercount,
            'salercount' => $salercount,
            'categorycount' => $categorycount,
            'jasacount' => $jasacount,
        ]);
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

        $model = Category::find()->orderBy(['created_at' => SORT_DESC])->all();
        // $count = $data->count();
        // $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        // $model = $data->offset($pagination->offset)
        //     ->limit($pagination->limit)
        //     ->all();

        return $this->render('kategori\category', [
            'model' => $model,
            // 'pagination' => $pagination
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

        //menampung category baru di variabel model
        $model = new Category();

        $gambar = $model->img;
        if ($model->load($_POST)) {
            $img = UploadedFile::getInstance($model, 'img');
            $model->created_at = date('Y-m-d H:i:s');
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
                Yii::$app->session->setFlash('success', 'Data berhasil di Buat');
                return $this->redirect(['category', 'id' => $model->id]);
            }
        }
        return $this->render('kategori\buat-category', [
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
            $model->updated_at = date('Y-m-d H:i:s');
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
        return $this->render('kategori\edit-category', [
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

        $model = JasaKirim::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('jasa\index', [
            'model' => $model,
        ]);
    }

    public function actionBuatJasa()
    {
        $val = Yii::$app->request->post();
        $model = new JasaKirim();

        if ($model) {
            $model->name = $val['name'];
            $model->slug = $val['slug'];
            $model->created_at = date('Y-m-d H:i:s');
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
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Data Berhasil Di Rubah');
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

    //Transaksi ===============================================================================================================
    public function actionPenjualan()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }

        $jasa = JasaKirim::find()->all();
        $model = Pesanan::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('Transaksi\semua-penjualan', [
            'model' => $model,
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
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->validate()) {
                $model->save();
                Yii::$app->session->setFlash('success', 'Data berhasil di rubah');
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

        $model = User::find()->where(['role_id' => 1])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('customer\customer-list', [
            'model' => $model,
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

    //Toko ====================================================================================================================
    public function actionPenjual()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        if (Yii::$app->user->identity->role_id != 2) {
            return $this->goHome();
        }

        $model = Toko::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('Toko\index', [
            'model' => $model,
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
            $produk = Products::find()->where(['toko_id' => $model->id])->all();
            foreach ($produk as $pd) {
                $favorit = Favorit::find()->where(['products_id' => $pd->id])->all();
                foreach ($favorit as $fv) {
                    $fv->delete();
                }
                $pd->delete();
            }
            $promo = Promo::find()->where(['toko_id' => $model->id])->all();
            foreach ($promo as $pr) {
                $pr->delete();
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

        $model = Toko::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('laporan\produk-penjual', [
            'model' => $model,
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

        // $data = Products::find()->with('category');
        // if (isset($_GET['Products'])) {
        //     $search_args = \Yii::$app->request->get()['Products'];
        //     $data->andFilterWhere([
        //         'category_id' => $search_args['category_id']
        //     ]);
        // }
        // $count = $data->count();
        // $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        // $produk = $data->offset($pagination->offset)
        //     ->limit($pagination->limit)
        //     ->all();

        $produk = Products::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('laporan\stok-produk', [
            'produk' => $produk,
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

        // $data = Products::find()->with('category');
        // if (isset($_GET['Products'])) {
        //     $search_args = \Yii::$app->request->get()['Products'];
        //     $data->andFilterWhere([
        //         'category_id' => $search_args['category_id']
        //     ]);
        // }
        // $count = $data->count();
        // $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        // $produk = $data->offset($pagination->offset)
        //     ->limit($pagination->limit)
        //     ->all();

        $produk = Products::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('laporan\jumlah-penjualan', [
            'produk' => $produk,
        ]);
    }

    //Upload Banner ============================================================================================================================
    public function actionBanner()
    {
        $model = Banner::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render('banner/index', [
            'model' => $model,
        ]);
    }

    public function actionBuatBanner()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = new Banner();

        $gambar = $model->image;
        if ($model->load($_POST)) {
            $image = UploadedFile::getInstance($model, 'image');
            $model->created_at = date('Y-m-d H:i:s');
            if ($image != NULL) {
                # store the source file name
                $model->image = $image->name;
                $arr = explode(".", $image->name);
                $extension = end($arr);

                # generate a unique file name
                $model->image = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->image;
                if ($gambar != NULL) {
                    $image->saveAs($path);
                } else {
                    $image->saveAs($path);
                }
            } else {
                $model->image = $gambar;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil di Buat');
                return $this->redirect(['banner', 'id' => $model->id]);
            }
        }
        return $this->render('banner\buat-banner', [
            'model' => $model,
        ]);
    }

    public function actionUpdateBanner($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $identy = Yii::$app->user->identity;
        if ($identy->role_id != 2) {
            return $this->goHome();
        }

        $model = Banner::findOne($id);

        $gambar = $model->image;
        if ($model->load($_POST)) {
            $image = UploadedFile::getInstance($model, 'image');
            if ($image != NULL) {
                # store the source file name
                $model->image = $image->name;
                $arr = explode(".", $image->name);
                $extension = end($arr);

                # generate a unique file name
                $model->image = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/upload/")) == false) {
                    mkdir(Yii::getAlias("@app/web/upload/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/upload/") . $model->image;
                if ($gambar != NULL) {
                    $image->saveAs($path);
                } else {
                    $image->saveAs($path);
                }
            } else {
                $model->image = $gambar;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Data berhasil di rubah');
                return $this->redirect('banner');
            }
        }
        return $this->render('banner\edit-banner', [
            'model' => $model,
        ]);
    }

    public function actionDeleteBanner($id)
    {
        Banner::findOne(['id' => $id])->delete();

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
            return $this->redirect(['banner']);
        }
    }
}
