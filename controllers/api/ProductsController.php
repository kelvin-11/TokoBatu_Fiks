<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */


class ProductsController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\Products";
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
    public function actionIndexs()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $produk = $this->modelClass::find()->all();

        return [
            'success' => true,
            'message' => 'success',
            'products' => $produk,
            'productsCount' => count($produk),
        ];
    }

    public function actionGetProduct($id)
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
    public function actionListProduk($id_kat = null)
    {
        $result = [];
        try {
            if ($id_kat != null) {
                $modelProduk = $this->modelClass::find()->where(['category_id' => $id_kat])->orderBy(['id' => SORT_DESC])->all();
                if ($modelProduk != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $modelProduk;
                } else {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $modelProduk;
                }
            } else {
                $modelProduk = $this->modelClass::find()->orderBy(['id' => SORT_DESC])->all();
                $result["success"] = true;
                $result["message"] = "success";
                $result["products"] = $modelProduk;
            }
            $result["productsCount"] = count($modelProduk);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["products"] = $modelProduk;
        }
        return $result;
    }

    public function actionLatesProduk()
    {
        $result = [];
        try {
            $modelProduk = $this->modelClass::find()->orderBy(['id' => SORT_DESC])->limit(6)->all();
            if ($modelProduk != null) {
                $result["success"] = true;
                $result["message"] = "success";
                $result["products"] = $modelProduk;
            } else {
                $result["success"] = true;
                $result["message"] = "success";
                $result["products"] = $modelProduk;
            }
            $result["productsCount"] = count($modelProduk);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["products"] = $modelProduk;
        }
        return $result;
    }
}
