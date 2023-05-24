<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\datas\Products $data */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'class' => 'border-dark form-control'])->label('Nama Toko', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'no_whatsapp')->textInput(['maxlength' => true, 'class' => 'border-dark form-control'])->label('No Whatsapp', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>

        <?= $form->field($model, 'alamat')->textInput(['maxlength' => true, 'class' => 'border-dark form-control'])->label('Alamat', ['class' => 'fw-bold text-dark ms-1']) ?>

        <?= $form->field($model, 'deskripsi')->textarea(['rows' => '6', 'class' => 'border-dark form-control'])->label('Deskripsi', ['class' => 'fw-bold text-dark ms-1']) ?>

        <?= $form->field($model, 'flag')->fileInput([
            'options' => ['accept' => 'Flag/*'],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                'maxFileSize' => 250,
            ],
            'class' => 'form-control border-dark'
        ])->label('Flag', ['class' => 'fw-bold text-dark ms-1']) ?>

        <div class="row">
            <div class="col-md-12 mt-2" style="text-align:center">
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn bg-gradient-success text-light']); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>