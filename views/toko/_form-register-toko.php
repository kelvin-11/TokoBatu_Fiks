<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\datas\Products $data */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama Toko') ?>

    <?= $form->field($model, 'no_whatsapp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deskripsi')->textarea(['rows' => '6'])->label('Deskripsi Toko') ?>

    <?= $form->field($model, 'flag')->fileInput([
        'options' => ['accept' => 'Flag/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
            'maxFileSize' => 250,
        ],
    ]) ?>
    <?php if ($model->flag != null) : ?>
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= Url::to(['/upload/' . $model->flag]) ?>" alt="" style="width: 250px;height: 250px;border-radius: 4%">
            </div>
            <div class="col-lg-6 col-md-offset-3">
                <div style="text-align:center">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-12 mt-2">
                <div style="text-align:center">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php ActiveForm::end(); ?>
</div>