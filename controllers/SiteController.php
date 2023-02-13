<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\JasaKirim;
use app\models\Pesanan;
use app\models\PesananDetail;
use app\models\Products;
use app\models\Toko;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $lates = Products::find()->limit(4)->all();

        $items = Products::find()->with('category');
        if (isset($_GET['Item'])) {
            $search_args = \Yii::$app->request->get()['Item'];
            $items->andFilterWhere([
                'category_id' => $search_args['category_id']
            ]);
        }

        $provider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => [
                'pageSize' => 4, //untuk menampilkan banyyak produk dihalaman utama
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                    'name' => SORT_ASC,
                ]
            ],
        ]);
        return $this->render('index', [
            'items' => $items,
            'provider' => $provider,
            'categories' => $categories,
            'lates' => $lates,
        ]);
    }

    public function actionDetail($id)
    {
        $model = Products::find()->where(['id' => $id])->one();
        if ($model->toko_id != null) {
            $toko = Toko::find()->where(['id' => $model->toko_id])->one();
            $produk = Products::find()->where(['toko_id' => $toko->id])->orderBy(['id' => SORT_DESC])->limit(4)->all();

            return $this->render('detail', [
                'produk' => $produk,
                'model' => $model
            ]);
        }
        return $this->render('detail', [
            'model' => $model
        ]);
    }

    public function actionShop()
    {
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            $get_id = Category::find()->where(['name' => $category])->one();
            $query = Products::find()->where(['category_id' => $get_id->id]);
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
            $model = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        } else {
            $query = Products::find();
            $count = $query->count();
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 9]);
            $model = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }

        $categories = Category::find()->all();
        $lates = Products::find()->orderBy(['id' => SORT_DESC])->limit(6)->all();

        return $this->render('shop', [
            'model' => $model,
            'lates' => $lates,
            'categories' => $categories,
            'pagination' => $pagination
        ]);
    }

    //Ajax Update keranjang
    public function actionUpdatekeranjang()
    {
        $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
        $data = PesananDetail::findOne($_GET['id']);
        if ($data) {
            $data->jml = $_GET['qty'];
            $data->total = $_GET['total'];
            if ($data->validate()) {
                $data->update();
                echo $pesanan->total_harga = PesananDetail::find()->where(['pesanan_id' => $data->pesanan_id])->sum('total');
                $pesanan->save();
            }
        }
    }

    public function actionCreateKeranjang()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $val = Yii::$app->request->post();

        //beginTransaction jika data tidak ke save maka akan default di hapus
        $transaction = Yii::$app->db->beginTransaction();
        $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();

        if (!$pesanan) {
            // tambah data pesanan
            $pesanan = new Pesanan();
            $pesanan->user_id = Yii::$app->user->identity->id;
            $pesanan->status = 0;
            $pesanan->kode_unik = random_int(0, 99999);
            $pesanan->total_harga = 0;
            $pesanan->status_pemesanan = 'pending';
            $pesanan->created_at = date('y:m:d H:i:s');
            $pesanan->updated_at = date('y:m:d H:i:s');
            if (!$pesanan->validate()) {
                //roleBack agar tidak jadi di save
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Terjadi kesalahan ketika menyimpan data.');
                return $this->redirect('index');
            }
            $pesanan->save();
        }
        // ambil data produk
        $produk = Products::findOne(['id' => $val["produk_id"]]);
        if (!$produk) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Produk tidak ditemukan.');
            return $this->redirect('index');
        }

        // tambah detail pesanan
        $data = PesananDetail::findOne(['pesanan_id' => $pesanan->id, 'products_id' => $produk->id]);
        if (!$data) {
            $data = new PesananDetail();
            $data->products_id = $produk->id;
            $data->pesanan_id = $pesanan->id;
            $data->jml = $val['qty'] ?? 1;
        } else {
            $data->jml += $val['qty'] ?? 1;
        }
        $data->total = $data->jml * $produk->harga;

        if ($data->validate()) {
            $data->save();
            // pembaruan nilai total pesanan
            $pesanan->total_harga = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->sum('total');
            $pesanan->save();
            //commit untuk meyimpan transaksi
            $transaction->commit();
            Yii::$app->session->setFlash('success', 'Barang berhasil dimasukkan ke dalam keranjang');
            return $this->goBack();
        } else {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Terjadi kesalahan ketika menambahkan produk ke keranjang.');
            return $this->redirect('index');
        }
    }

    public function actionKeranjang()
    {
        if (yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
        if ($pesanan) {
            $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->all();
        } else {
            Yii::$app->session->setFlash('error', 'Keranjang Anda Kosong');
            return $this->redirect('index');
        }

        return $this->render('keranjang', [
            'pesanan' => $pesanan,
            'pesanan_detail' => $pesanan_detail
        ]);
    }

    public function actionRemoveKeranjang($id)
    {
        $pesanan_detail = PesananDetail::findOne($id);

        if ($pesanan_detail) {
            $pesanan = Pesanan::find()->where(['id' => $pesanan_detail->pesanan_id])->one();
            $jumlah_pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
            if ($jumlah_pesanan_detail == 1) {
                $pesanan->delete();
                Yii::$app->session->setFlash('success', 'Pesanan Anda berhasil dihapus');
                return $this->redirect('index');
            } else {
                $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->total;
                $pesanan->update();
            }
            $pesanan_detail->delete();
            Yii::$app->session->setFlash('success', 'Produk berhasil dihapus');
            return $this->redirect('keranjang');
        }
    }

    //API Raja Ongkir provinsi
    public function actionProvinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: c51cd96ff8594d4cc7cbd2d0a09e737c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $provinsi = json_decode($response, TRUE);
            $dataprovinsi = $provinsi['rajaongkir']['results'];

            $text = "<select required class='nice-select' name='provinsi' id='provinsi' style='display:block'>";
            $text .= "<option value=''>--Pilih Provinsi--</option>";
            foreach ($dataprovinsi as $pv) {
                $text .= "<option
                id_provinsi='" . $pv["province_id"] . "'>";

                $text .= $pv["province"];
                $text .= "</option>";
                // echo "<option value='".$pv["province_id"]."'>";
                // echo $pv["province"];
                // echo "</option>";
            }
            $text .= "</select>";
            return $text;
        }
    }

    //API Raja Ongkir Kota/Kabupaten
    public function actionDistrik()
    {
        $id_provinsi_terpilih = $_POST['id_provinsi'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?&province=" . $id_provinsi_terpilih,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: c51cd96ff8594d4cc7cbd2d0a09e737c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $distrik = json_decode($response, TRUE);
            $datadistrik = $distrik['rajaongkir']['results'];

            $text = "<select required class='nice-select' name='distrik' id='distrik' style='display:block'>";
            $text .= "<option value=''>--Pilih Kota/Kabupaten--</option>";
            foreach ($datadistrik as $ds) {
                $text .= "<option 
                id_distrik='" . $ds["city_id"] . "' 
                nama_provinsi='" . $ds["province"] . "' 
                nama_distrik='" . $ds["city_name"] . "' 
                type_distrik='" . $ds["type"] . "' 
                codepos='" . $ds["postal_code"] . "'>";

                $text .= $ds["type"] . " ";
                $text .= $ds["city_name"];
                $text .= "</option>";
            }
            $text .= "</select>";
            return $text;
        }
    }

    //API Raja Ongkir Paket pengiriman
    public function actionPaket()
    {
        $jasa_terpilih = $_POST["jasa"];
        $distrik_terpilih = $_POST["distrik"];
        $berat_total = $_POST["berat"];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=501&destination=" . $distrik_terpilih . "&weight=" . $berat_total . "&courier=" . $jasa_terpilih,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: c51cd96ff8594d4cc7cbd2d0a09e737c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response, TRUE);
            $datapaket = $ongkir['rajaongkir']['results']['0']['costs'];

            $text = "<select required class='nice-select' name='paket' id='paket' style='display:block'>";
            $text .= "<option value=''>--Pilih Paket Kirim--</option>";
            foreach ($datapaket as $pt) {
                $text .= "<option 
                isi_paket='" . $pt["service"] . "'
                ongkir='" . $pt["cost"]['0']['value'] . "'
                etd='" . $pt["cost"]['0']['etd'] . "'>";

                $text .= $pt["service"] . " ";
                $text .= number_format($pt["cost"]['0']['value']) . " ";
                $text .= $pt["cost"]['0']['etd'] . "<p>Hari</p>";
                $text .= "</option>";
            }
            $text .= "</select>";
            return $text;
        }
    }

    public function actionUpdate()
    {
        $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
        if ($pesanan) {
            $pesanan->paket = $_POST['isi_paket'];
            echo $pesanan->ongkir = $_POST['ongkir'];
            $pesanan->estimasi = $_POST['estimasi'];
            if ($pesanan->validate()) {
                $pesanan->update();
            }
        }
    }

    public function actionCreateCheckout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $val = Yii::$app->request->post();

        $transaction = Yii::$app->db->beginTransaction();
        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
        if ($user) {
            $user->alamat = $val['alamat'];
            $user->kota = $val['distrik'];
            $user->provinsi = $val['provinsi'];
            $user->type = $val['type'];
            $user->no_hp = $val['no_hp'];
            $user->codepos = $val['codepos'];
            $user->email = $val['email'];
            if ($user->validate()) {
                $user->update();
                $transaction->commit();
            } else {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Mohon Lengkapi Data Pesanan!');
                return $this->redirect('checkout');
            }

            $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
            $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->all();
            if ($pesanan_detail) {
                foreach ($pesanan_detail as $pd) {
                    $produk = Products::find()->where(['id' => $pd->products_id])->one();
                    $produk->stok = $produk->stok - $pd->jml;
                    $produk->update();
                }
            } else {
                Yii::$app->session->setFlash('error', 'Gagal memproses data');
                return $this->redirect('checkout');
            }

            if ($pesanan) {
                $pesanan->status = 1;
                $pesanan->jasa_id = $val['select'];
                $pesanan->status_pemesanan = 'dikonfirmasi';
                if ($pesanan->validate()) {
                    $pesanan->update();
                    //mengirim pesan ke pembeli melalui whatsapp
                    $phone_sender = substr_replace($pesanan->user->no_hp, '62', 0, 1);
                    $pesan_sender = "Salam kak {$pesanan->user->name}, ini adalah pesan otomatis dari Toko Batu.
Kami ucapkan terima kasih karena telah berbelanja di toko kami. Jangan lupa untuk konfirmasi bila barang sudah diterima dan tolong bantu kami dengan memberi bintang 5..
                    
Kirimkan Rating kepada Toko Kami setelah Pengiriman Selesai pada link diberikut.
Pemesanan Hubunggi :https://wa.me/6285708217852 
                                                            
Terimakasih telah berbelanja di Toko Batu 
Pesan ini tidak perlu dibalas dan bukan nomor pemesanan order";
                    $this->Send($phone_sender, $pesan_sender);
                    //return ke pembayaran Midtrans
                    return $this->redirect(['pembayaran-header', 'id' => $pesanan->id]);
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Mohon Pilih Metode Pengiriman!');
                    return $this->redirect('checkout');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Tidak bisa memproses data');
                return $this->redirect('index');
            }
        }
    }

    //API message via Whatsapp
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

    public function actionCheckout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $pengiriman = JasaKirim::find()->all();
        $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
        if ($pesanan == null) {
            Yii::$app->session->setFlash('error', 'Anda Tidak Memiliki Pesanan!');
            return $this->redirect('index');
        }
        $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->all();

        return $this->render('checkout', [
            'pesanan' => $pesanan,
            'pesanan_detail' => $pesanan_detail,
            'pengiriman' => $pengiriman,
        ]);
    }

    //API pyment Midtrans
    protected function actionMidtrans($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $id . "/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1wM1p6TTFqLUs5blY3U1BrazVZUXotR2s6" //encode base64 dari SB mitrans
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    //Action Pembayaran Midtrans
    public function actionPembayaranHeader($id)
    {
        $model = Pesanan::findOne($id);
        $detail = PesananDetail::find()->where(['pesanan_id' => $model->id])->all();

        $total_biaya = $model->total_harga + $model->ongkir;

        $order_id_midtrans = rand();
        $model->code_transaksi_midtrans = $order_id_midtrans;

        $transaction_details = array(
            'order_id' => $order_id_midtrans,
            'gross_amount' => (int)$total_biaya,
        );

        // Optional
        $shipping_address = array(
            'first_name'    => (string)$model->user->name,
            'last_name'     => "",
            'address'       => (string)$model->user->alamat,
            'city'          => (string)$model->user->kota,
            'postal_code'   => (int)$model->user->codepos,
            'phone'         => (string)$model->user->no_hp,
            'country_code'  => ""
        );

        $item1_details = array();
        foreach ($detail as $data) {
            $item1_details[] = array(
                'id' => (int)$data->id,
                'price' => (int)$data->products->harga,
                'quantity' => (int)$data->jml,
                'name' => (string)$data->products->name,
            );
        }
        $item1_details[] = array(
            'id' => (int)$model->jasa_id,
            'price' => (int)$model->ongkir,
            'quantity' => 1,
            'name' => (string)$model->jasa->name,
        );

        $customer_details = array(
            'first_name'    => Yii::$app->user->identity->name,
            'last_name'     => "",
            'email'         => Yii::$app->user->identity->email,
            'phone'         => Yii::$app->user->identity->no_hp,
            'billing_address'  => "",
            'shipping_address' => $shipping_address
        );

        $hasil_code = \app\components\ActionMidtrans::toReadableOrder($item1_details, $transaction_details, $customer_details, $shipping_address);
        $model->code_transaksi_midtrans = $hasil_code;
        $hasil = 'https://app.sandbox.midtrans.com/snap/v2/vtweb/' . $hasil_code;

        if ($model->validate()) {
            $model->save();
            return $this->redirect(['pembayaran', 'id' => $model->id]);
        }
    }

    //View Pembayaran Midtrans
    public function actionPembayaran($id)
    {
        $pesanan = Pesanan::findOne($id);
        return $this->render('pembayaran', [
            'pesanan' => $pesanan
        ]);
    }

    public function actionKonfirmasi()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/TokoBatu/web/login/login');
        }

        $user = User::findOne(Yii::$app->user->identity->id);
        $pesanans = Pesanan::find()->where(['user_id' => $user->id])->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(1)->one();
        if ($pesanans == null) {
            Yii::$app->session->setFlash('error', 'Anda Tidak Memiliki Riwayat Transaksi');
            return $this->redirect('index');
        }
        $pesanan_details = PesananDetail::find()->where(['pesanan_id' => $pesanans->id])->count();

        return $this->render('konfirmasi', [
            'pesanans' => $pesanans,
            'pesanan_details' => $pesanan_details,
        ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSearch()
    {
        $q = Yii::$app->request->post('q'); // atau juga bisa $_POST['q'];
        $produk = Products::find()->where(['like', 'name', $q])->all(); //mencari semua produk berdasarkan nama

        $template = "";
        $index = "";

        foreach ($produk as $prd) {
            $template .= $this->renderPartial('_items', ['model' => $prd]);
        } //untuk halaman shop

        foreach ($produk as $pr) {
            $index .= $this->renderPartial('_item', ['model' => $pr]);
        } //untuk halaman index

        Yii::$app->response->format = Response::FORMAT_JSON; //merubah format menjadi JSON

        return [
            'data' => $template,
            'index' => $index,
        ];
    }
}
