<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Daftar Sekarang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 90vh">
            <div class="col-md-6">
                <div class="card-header text-light mb-5" style="background-color:#7fad39;box-shadow: 0.5rem 0.5rem 0.5rem 0.5rem rgba(0,0,0,.15)!important;">
                    <h3 class="text-center"><b>
                            <h3 class="text-light fw-bold mt-2"><?= Html::encode($this->title) ?></h3>
                            <h6 class="text-light py-2">Sudah Punya Akun Toko Batu? <a href="<?= \yii\helpers\Url::to(['/login/login']) ?>" class="text-dark fw-bold">Login</a></h6>
                        </b></h3>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 ms-5">
                                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                                <?= $form->field($model, 'email') ?>

                                <?= $form->field($model, 'password')->passwordInput() ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-secondary mb-3 mt-3', 'name' => 'signup-button']) ?>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>