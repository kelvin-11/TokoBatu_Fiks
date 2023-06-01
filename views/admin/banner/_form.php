<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="Banner-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <?= $form->field($model, 'image')->fileInput([
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp', 'jfif'],
                    'maxFileSize' => 250,
                ],
                'class' => 'form-control border-dark',
            ])->label('Banner', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'date_start')->textInput(['maxlength' => true, 'type' => 'date', 'class' => 'form-control border-dark', 'required' => true, 'value' => $model->date_start ? date('Y-m-d', strtotime($model->date_start)) : ''])
                ->label('Tanggal Mulai', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'date_end')->textInput(['maxlength' => true, 'type' => 'date', 'class' => 'form-control border-dark', 'required' => true, 'value' => $model->date_end ? date('Y-m-d', strtotime($model->date_end)) : ''])
                ->label('Tanggal Selesai', ['class' => 'fw-bold text-dark ms-1']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-2" style="text-align:center">
            <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn bg-primary-gradient text-light']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>