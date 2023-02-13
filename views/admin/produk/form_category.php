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
        <div class="col-lg-6">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama Category') ?>

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'img')->fileInput([
                'options' => ['accept' => 'img/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                    'maxFileSize' => 250,
                ],
                'class' => 'form-control'
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?php if ($model->img != null) : ?>
            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 300px;height: 250px;border-radius: 4%">
                </div>
                <div class="col-lg-6 col-md-offset-3">
                    <div style="text-align:center">
                        <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-12 mt-2">
                    <div style="text-align:center">
                        <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>