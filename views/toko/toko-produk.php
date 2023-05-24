<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk</h1>
</div>

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <div style="justify-content: space-between;display:flex">
            <h6 class="m-0 font-weight-bold text-primary" style="padding-top: 10px;">DataTabel Produk</h6>
            <?= Html::a('<i class="fa fa-plus"></i> Tambah Baru', ['create-produk', 'id' => Yii::$app->user->identity->id], ['class' => 'btn bg-gradient-success text-light fw-bold', 'style' => 'width:150px;']) ?>
        </div>
    </div>
    <div class="card-body">
        <?= GridView::widget([
            'layout' => "{items}<div class='d-flex justify-content-center'>{pager}</div>",
            'dataProvider' => $dataProvider,
            // 'pager'        => [
            //     'class'          => yii\widgets\LinkPager::className(),
            // ],
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-bordered', "id" => "dataTable", "width" => "100%", "cellspacing" => "0"],
            'headerRowOptions' => ['class' => 'text-dark fw-bold'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'name',
                    'filter' => false,
                ],
                [
                    'attribute' => 'harga',
                    'filter' => false,
                    'value' => function ($model) {
                        return number_format($model->harga);
                    },
                ],
                [
                    'attribute' => 'stok',
                    'filter' => false,
                ],
                \app\components\ActionButton::getButtonsSaya(),
            ],
        ]); ?>
    </div>
</div>