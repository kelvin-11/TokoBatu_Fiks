<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\datas\Products $data */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="item-form mb-3">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Nama Produk') ?>

    <?= $form->field($model, 'harga')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'stok')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'berat')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['class' => 'w-100', 'prompt' => 'Select Category']) ?>

    <?= $form->field($model, 'deskripsi_produk')->textarea(['rows' => '6']) ?>

    <?= $form->field($model, 'img')->fileInput([
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
            'maxFileSize' => 250,
        ],
    ]) ?>
    <?php if ($model->img != null) : ?>
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 260px;height: 260px;border-radius: 4%">
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