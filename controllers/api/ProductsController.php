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
    public function actionIndex(){
        $data= $this->modelClass::find()->all();
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
    }

    public function actionGetProduct($id){
        $data= $this->modelClass::find()->where(['id'=>$id])->one();
        if(isset($data)){
            return [
                "success" => true,
                "message" => "Data Ditemukan",
                "data" => $data
            ];
        }else{
            return [
                "success" => false,
                "message" => "Data Tidak Ditemukan"
            ];
        }
            
    }
}
