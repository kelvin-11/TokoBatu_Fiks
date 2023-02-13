<?php
/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;

use yii\helpers\Html;

class ActionButton
{
public static function getButtonsSaya($btn_pengajuan_selanjutnya = false)
    {
        $btn = [
            'view' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-eye'></i>", ["toko/view-produk", "id"=>$model->id], ["class"=>"btn btn-success", "title"=>"View","style"=>"width:45px"]);
            },
            'update' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-edit'></i>", ["toko/edit-produk", "id"=>$model->id], ["class"=>"btn btn-warning", "title"=>"Edit","style"=>"width:45px"]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-trash'></i>", ["toko/delete-produk", "id"=>$model->id], [
                    "class"=>"btn btn-danger",
                    "style" => "width:45px",
                    "title"=>"Hapus",
                    "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                ]);
            },
        ];
        $template = '{view} {update} {delete}';

        return [
            'class' => 'yii\grid\ActionColumn',
            'template' => $template,
            'buttons' => $btn,
            'contentOptions' => ['nowrap'=>'nowrap', 'style'=>"text-align:center;"]
        ];
    }
}