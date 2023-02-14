<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */


class CategoryController extends \yii\rest\ActiveController
{
    public $modelClass = "app\models\Category";
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
}
