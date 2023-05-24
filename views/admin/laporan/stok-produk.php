<?php

use app\models\Category;
use app\models\Products;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Laporan Stok Produk</h4>
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
            <a href="#">Laporan Stok Produk</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Laporan Stok Produk</div>
                <!-- <div style="justify-content: space-between;display:flex">
                    <a href="<?= Url::to(['/admin/stok-produk']) ?>" class="btn bg-success-gradient text-light ms-5">Semua Category</a>
                </div> -->
            </div>

            <div class="card-body">
                <!-- <div class="row ms-5">
                    <div class="col-lg-10">
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'layout' => 'horizontal',
                            'method' => 'get',
                            'action' => \yii\helpers\Url::to(['admin/stok-produk']),
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
                </div> -->
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($produk as $laporan) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $laporan->name ?></td>
                                    <td><?= $laporan->stok ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>