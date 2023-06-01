<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */


class BannerController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\Banner";
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
        $data = $this->modelClass::find()->where(['>=', 'date_end', date('Y-m-d')])->all();
        $dataCount = $this->modelClass::find()->where(['>=', 'date_end', date('Y-m-d')])->count();
            if($dataCount != 0){
                return [
                    "success" => true,
                    "message" => "Data Ditemukan",
                    "data" => $data
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Data Kosong",
                    "data" => null
                ];
            }
    }
}