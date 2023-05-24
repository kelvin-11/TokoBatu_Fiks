<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\datas\Products $data */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="item-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'name',)->textInput(['maxlength' => true, 'autofocus' => true, 'class' => 'border-dark form-control'])->label('Nama Produk', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'harga')->textInput(['type' => 'number', 'class' => 'border-dark form-control'])->label('Harga', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'stok')->textInput(['type' => 'number', 'class' => 'border-dark form-control'])->label('Stok', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'berat')->textInput(['type' => 'number', 'class' => 'border-dark form-control'])->label('Berat (Gram)', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>

        <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['class' => 'w-100 form-select border-dark', 'prompt' => 'Pilih Kategori'])->label('Kategori', ['class' => 'fw-bold text-dark ms-1']) ?>

        <?= $form->field($model, 'deskripsi_produk')->textarea(['rows' => '6', 'class' => 'border-dark form-control'])->label('Deskripsi Produk', ['class' => 'fw-bold text-dark ms-1']) ?>

        <?= $form->field($model, 'img')->fileInput([
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                'maxFileSize' => 250,
            ],
            'class' => 'form-control border-dark'
        ])->label('Foto Produk', ['class' => 'fw-bold text-dark ms-1']) ?>
    </div>

    <div class="row">
        <div class="col-md-12 mt-2" style="text-align:center">
            <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn bg-gradient-success text-light']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>