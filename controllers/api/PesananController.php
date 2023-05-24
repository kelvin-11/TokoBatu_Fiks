<?php

namespace app\controllers\api;

use app\components\Helper;
use app\models\PesananDetail;
use app\models\Products;
use app\models\User;
use Yii;

/**
 * This is the class for REST controller "UserController".
 */


class PesananController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\Pesanan";
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "only" => ["create-keranjang", "updated", "checkout", "get-pesanan-user", 'my-order'],
        ];

        return $parent;
    }
    protected function verbs()
    {
        return [
            'create-keranjang' => ['POST'],
            'get-pesanan' => ['GET'],
            'get-pesanan-user' => ['GET'],
            'remove-keranjang' => ['POST'],
            'updated' => ['POST'],
            'checkout' => ['POST'],
            'my-order' => ['GET']
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
    public function actionIndex()
    {
        $data = $this->modelClass::find()->all();
        return [
            "success" => true,
            "message" => "Data Ditemukan",
            "data" => $data
        ];
    }

    public function actionGetPesanan($id)
    {
        $data = $this->modelClass::find()->where(['id' => $id])->one();
        if (isset($data)) {
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
        } else {
            return [
                "success" => false,
                "message" => "Data Tidak Ditemukan"
            ];
        }
    }
    public function actionGetPesananUser()
    {
        $data = $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->all();
        if (isset($data)) {
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data,
            ];
        } else {
            return [
                "success" => false,
                "message" => "Data Tidak Ditemukan"
            ];
        }
    }

    public function actionCreateKeranjang()
    {

        $val = Yii::$app->request->post();

        //beginTransaction jika data tidak ke save maka akan default di hapus
        $transaction = Yii::$app->db->beginTransaction();
        $pesanan = $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();

        if (!$pesanan) {
            // tambah data pesanan
            $pesanan = new $this->modelClass;
            $pesanan->user_id = Yii::$app->user->identity->id;
            $pesanan->status = 0;
            $pesanan->kode_unik = random_int(0, 99999);
            $pesanan->total_harga = 0;
            $pesanan->status_pemesanan = 'pending';
            $pesanan->created_at = date('y:m:d H:i:s');
            $pesanan->updated_at = date('y:m:d H:i:s');
            if (!$pesanan->validate()) {
                //roleBack agar tidak jadi di save
                return [
                    "success" => false,
                    "message" => "Gagal Menyimpan Data"
                ];
            }
            $pesanan->save();
        }
        // ambil data produk
        $produk = Products::findOne(['id' => $val["produk_id"]]);
        if (!$produk) {
            return [
                "success" => false,
                "message" => "Produk Tidak Diketahui"
            ];
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
            return [
                "success" => true,
                "message" => "Barang berhasil dimasukkan ke dalam keranjang"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Terjadi kesalahan ketika menambahkan produk ke keranjang."
            ];
        }
    }
    public function actionUpdated()
    {

        $val = Yii::$app->request->post();
        $pesanan = $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
        $data = PesananDetail::findOne(['id' => $val['id']]);
        if ($data) {
            $produk = Products::findOne(['id' => $data->products_id]);
            $data->jml = $val['qty'];
            $data->total = (int)$val['qty'] * $produk->harga;
            if ($data->validate()) {
                $data->update();
                $pesanan->total_harga = PesananDetail::find()->where(['pesanan_id' => $data->pesanan_id])->sum('total');
                $pesanan->save();
                return [
                    "success" => true,
                    "message" => "Berhasil update keranjang"
                ];
            }
        } else {
            return [
                "success" => false,
                "message" => "Data tidak ditemukan"
            ];
        }
    }
    public function actionRemoveKeranjang()
    {

        $val = Yii::$app->request->post();
        $pesanan_detail = PesananDetail::findOne(['id' => $val['id']]);
        if ($pesanan_detail) {
            $pesanan = $this->modelClass::find()->where(['id' => $pesanan_detail->pesanan_id])->one();
            $jumlah_pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
            if ($jumlah_pesanan_detail == 1) {
                $pesanan->delete();
                return [
                    "success" => true,
                    "message" => "Pesanan Anda berhasil dihapus"
                ];
            } else {
                $pesanan->total_harga = $pesanan->total_harga - $pesanan_detail->total;
                $pesanan->update();
            }
            $pesanan_detail->delete();
            return [
                "success" => true,
                "message" => "Produk berhasil dihapus"
            ];
        } else {
            return [
                "success" => false,
                "message" => "Data tidak ditemukan"
            ];
        }
    }
    public function actionCheckout()
    {
        try {
            $val = Yii::$app->request->post();

            $transaction = Yii::$app->db->beginTransaction();
            $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
            if ($user) {
                $user->alamat = $val['alamat'];
                $user->provinsi = $val['provinsi'];
                $user->kota = $val['district'];
                $user->type = $val['type'];
                $user->no_hp = $val['no_hp'];
                $user->codepos = $val['codepos'];
                $user->email = $val['email'];
                if ($user->validate()) {
                    $user->update();
                    $transaction->commit();
                } else {
                    return [
                        "success" => false,
                        "message" => "Mohon Lengkapi Data Pesanan!"
                    ];
                }

                $pesanan = $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
                $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->all();
                if ($pesanan_detail) {
                    foreach ($pesanan_detail as $pd) {
                        $produk = Products::find()->where(['id' => $pd->products_id])->one();
                        $produk->stok = $produk->stok - $pd->jml;
                        $produk->update();
                    }
                } else {
                    return [
                        "success" => false,
                        "message" => "Gagal memproses data!"
                    ];
                }

                if ($pesanan) {
                    $pesanan->status = 1;
                    $pesanan->jasa_id = $val['jasa'];
                    $pesanan->status_pemesanan = 'dikonfirmasi';
                    if ($pesanan->validate()) {
                        $pesanan->update();
                        //return ke pembayaran Midtrans
                        return $this->actionBayar($pesanan->id);
                    } else {
                        return [
                            "success" => false,
                            "message" => "Mohon Pilih Metode Pengiriman!"
                        ];
                    }
                } else {
                    return [
                        "success" => false,
                        "message" => "Tidak bisa memproses data"
                    ];
                }
            }
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "message" => "Isi data dengan benar"
            ];
        }
    }

    public function actionUpdatePesanan()
    {
        try {
            $val = Yii::$app->request->post();

            $pesanan =  $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
            if ($pesanan) {
                $pesanan->paket = $val['paket'];
                $pesanan->ongkir = $val['ongkir'];
                $pesanan->estimasi = $val['estimasi'];
                // $pesanan->total_harga += $val['ongkir'];
                if ($pesanan->validate()) {
                    $pesanan->update();
                    return [
                        "success" => true,
                        "message" => "Berhasil Update Pesanan"
                    ];
                }
            }
        } catch (\Throwable $th) {
            return [
                "success" => false,
                "message" => "Isi data dengan benar"
            ];
        }
    }


    //Action Pembayaran Midtrans
    protected function actionBayar($id)
    {
        $model = $this->modelClass::findOne($id);
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

            //mengirim pesan ke pembeli melalui whatsapp
            $phone_sender = substr_replace($model->user->no_hp, '62', 0, 1);
            $pesan_sender = "Salam kak {$model->user->name}, ini adalah pesan otomatis dari Toko Batu.
Kami ucapkan terima kasih karena telah berbelanja di toko kami. Jangan lupa untuk konfirmasi bila barang sudah diterima dan tolong bantu kami dengan memberi bintang 5..
                    
Kirimkan Rating kepada Toko Kami setelah Pengiriman Selesai pada link diberikut.
Pemesanan Hubunggi :https://wa.me/6285708217852 
                                                            
Terimakasih telah berbelanja di Toko Batu 
Pesan ini tidak perlu dibalas dan bukan nomor pemesanan order";
            Helper::Send($phone_sender, $pesan_sender);
            return ['success' => true, 'message' => 'success', 'data' => $model, 'code' => $hasil_code, 'url' => $hasil];
        } else {
            return ['success' => false, 'message' => 'Gagal melakukan pembayaran midtrans', 'data' => []];
        }
    }

    public function actionMyOrder()
    {
        $data = $this->modelClass::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        if (isset($data)) {
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
        } else {
            return [
                "success" => false,
                "message" => "Data Tidak Ditemukan"
            ];
        }
    }
    
    public function actionDetails($id)
    {
        $data = $this->modelClass::find()->where(['id' => $id])->all();
        if (isset($data)) {
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
        } else {
            return [
                "success" => false,
                "message" => "Data Tidak Ditemukan"
            ];
        }
    }
}
