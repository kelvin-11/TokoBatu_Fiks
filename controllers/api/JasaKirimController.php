<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */


class JasaKirimController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\JasaKirim";
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
    public function actionIndex(){
        $data= $this->modelClass::find()->all();
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
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

            $data = [
                "message" => "Data berhasil ditampilkan",
                "data" => $dataprovinsi,
            ];
            return $data;
        }
    }

    //API Raja Ongkir Kota/Kabupaten
    public function actionDistrict()
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

            $data = [
                "message" => "Data berhasil ditampilkan",
                "data" => $datadistrik,
            ];
            return $data;
        }
    }

    //API Raja Ongkir Paket pengiriman
    public function actionPaket()
    {
        $jasa_terpilih = $_POST["jasa"];
        $distrik_terpilih = $_POST["district"];
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
            // var_dump($ongkir);die;
            $datapaket = $ongkir['rajaongkir']['results']['0']['costs'];

            $data = [
                "message" => "Data berhasil ditampilkan",
                "data" => $datapaket,
            ];
            return $data;
        }
    }
}
