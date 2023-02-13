<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p><i class="icon fa fa-check"></i>Saved!</p>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<div class="site-login">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 70vh;">
            <div class="col-md-6">
                <div class="card-header text-light mb-5" style="background-color:#7fad39;box-shadow: 0.5rem 0.5rem 0.5rem 0.5rem rgba(0,0,0,.15)!important;">
                    <h3 class="text-center"><b>
                            <h2 class="text-light py-2 fw-bold"><?= Html::encode($this->title) ?></h2>
                        </b></h3>
                    <div class="card-body">
                        <div class="row">
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{input}\n{error}",
                                    'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3 '],
                                    'inputOptions' => ['class' => 'col-lg-8 form-control'],
                                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                                ],
                            ]); ?>

                            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <h6 class="text-center text-light fw-medium mt-3 mb-3 ">Belum Punya Akun? <a class="text-dark fw-bold" href="<?= \yii\helpers\Url::to(['/login/signup']) ?>">Register!</a></h6>

                            <div class="form-group">
                                <div class="offset-lg-5 col-lg-12">
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-secondary', 'name' => 'login-button']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>