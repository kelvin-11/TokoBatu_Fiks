<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p><i class="icon fa fa-check"></i>Saved!</p>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <?= $this->render('sidemenu/toko', [
                        'data' => $data,
                    ]) ?>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                    <div class="card bg-warning mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-9 mt-2">
                                    <h4 class="text-isalam-1 font-weight-bold text-detail-program">Produk Saya</h4>
                                </div>
                                <div class="col-lg-2 ms-3 mt-2">
                                    <p>
                                        <?= Html::a('<i class="fa fa-plus"></i> Tambah Baru', ['create-produk', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-success', 'style' => 'width:140px']) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row pl-20 pr-20">
                                <div class="table-responsive mt-2">
                                    <?= GridView::widget([
                                        'layout' => "{summary}{items}<div class='product__pagination d-flex justify-content-center'>{pager}</div>",
                                        'dataProvider' => $dataProvider,
                                        'pager'        => [
                                            'class'          => yii\widgets\LinkPager::className(),
                                        ],
                                        // 'filterModel' => $searchModel,
                                        'tableOptions' => ['class' => 'table table-dark text-light text-center fw-bold'],
                                        'headerRowOptions' => ['class' => 'text-warning fw-bold'],
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
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>