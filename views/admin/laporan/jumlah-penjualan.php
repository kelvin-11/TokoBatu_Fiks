<?php

use app\models\Category;
use app\models\Products;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Laporan</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?= Url::to(['index']); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Laporan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Jumlah Penjualan</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card-title">Laporan Jumlah Penjualan</div>
                    </div>
                    <div class="col-lg-3">
                        <a href="<?= Url::to(['/admin/jumlah-penjualan']) ?>" class="btn btn-success ms-5">Semua Category</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row ms-5">
                    <div class="col-lg-10">
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'method' => 'get',
                            'action' => \yii\helpers\Url::to(['admin/jumlah-penjualan']),
                        ]);
                        if (isset($_GET['Products'])) {
                            $Products_model = new Products();
                            $Products_model->category_id = \yii::$app->request->get()['Products']['category_id'];
                        }
                        ?>
                        <?= $form->field(new Products(), 'category_id', [
                            'labelOptions' => ['class' => 'col-sm-2 col-form-label fs-5'],
                        ])->dropDownList(\yii\helpers\ArrayHelper::map(Category::find()->all(), 'id', 'name'))->label('Category :') ?>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::submitButton('Filter', ['class' => 'btn btn-info', 'name' => 'filter-button']) ?>
                    </div>
                    <?php ActiveForm::end();  ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-info text-center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Produk Terjual</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($produk as $laporan) {
                            $terjual = \app\models\Products::find()
                                ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
                                ->where(['products_id' => $laporan->id])
                                ->sum('pesanan_detail.jml');
                            if ($terjual) {
                                $p = $terjual;
                            } else {
                                $p = 0;
                            }
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $laporan->name ?></td>
                                    <td><?= $p ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center mt-2">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>