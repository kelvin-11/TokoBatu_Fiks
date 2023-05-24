<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'class' => 'border-dark form-control'])->label('Nama Kategori', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <?= $form->field($model, 'img')->fileInput([
                'options' => ['accept' => 'img/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                    'maxFileSize' => 250,
                ],
                'class' => 'form-control border-dark'
            ])->label('gambar', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-2" style="text-align:center">
            <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn bg-primary-gradient text-light']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>