<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'REGISTER';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .hg-row {
        display: flex;
        height: 98vh;
        align-items: center;
        justify-content: center;
    }

    .glass-card {
        box-sizing: border-box;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        backdrop-filter: blur(5px);
        /* border: 1px solid rgba(255, 255, 255, 0.3); */
        border: none;
        overflow: hidden;
        background: linear-gradient(9deg, rgba(0, 112, 255, 1) 0%, rgba(124, 207, 0, 1.0) 100%);
        box-shadow: 0.3rem 0.3rem 0.3rem 0.3rem rgba(0, 0, 0, .15) !important;
    }

    .pict-login {
        width: 100%;
        height: 490px;
        background: #fff;
        background-position: center;
        border-radius: 20px 0px 0px 20px;
        padding: 0;
    }

    .border-img {
        border-radius: 20px 0px 0px 20px;
    }

    .text-header {
        text-align: center;
        padding-bottom: 1.8rem;
        margin-bottom: 1.8rem;
        font-family: "Ubuntu", sans-serif;
        font-weight: 700;
        font-size: 1.6rem;
        line-height: 1.2;
        color: #fff;
        margin-top: 0;
        box-sizing: border-box;
    }

    .input-group {
        background: #fff;
        font-family: "Ubuntu", sans-serif;
        font-size: 14px;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        border-width: 0px;
        padding: 7px 15px 7px 30px;
        color: black;
        height: 40px;
        width: 92%;
        border: none;
    }

    .input-group-text {
        background: #fff;
        font-size: 14px;
        border-top-left-radius: 20px;
        border-top-right-radius: 0px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 0px;
        border-width: 0px;
        padding: 07px 0px 7px 15px;
        color: black;
        height: 40px;
        margin-left: 1%;
        border: none;
    }

    .btn-submit {
        background-image: linear-gradient(to right, #c3cfe2 0%, #f5f7fa 51%, #c3cfe2 100%);
        background-size: 150% auto;
        z-index: 2;
        display: inline-block;
        transition: all 400ms linear;
        color: #262627;
        font-size: 14px;
        font-weight: 600;
        font-family: "Ubuntu", sans-serif;
        border-radius: 20px;
        border-width: 0px;
        padding: 6px 15px 6px 15px;
        box-shadow: 0px 10px 30px 0px rgba(72, 175, 228, 1);
        border: none;
        height: 38px;
        margin-top: 5%;
    }
</style>

<div class="row hg-row">
    <div class="col-lg-8 col-md-8">

        <div class="d-flex glass-card row">
            <div class="col-lg-5 pict-login d-none d-lg-flex align-items-end">
                <img class="img-fluid d-block border-img" src="<?= yii\helpers\Url::to(['/img/Mobile-rafiki.png']) ?>" alt="" width="400">
            </div>
            <div class="col-lg-7 d-flex align-items-center justify-content-center">
                <div style="width: 70%;">
                    <p class="text-header">Create an account</p>
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-signup',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            // 'template' => "{label}\n{input}\n{error}",
                            'template' => "{input}\n{error}",
                            // 'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3 '],
                            'inputOptions' => ['class' => 'input-group'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'name', ['template' => '
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                {input}
                            </div>
                        {error}{hint}
                    '])->textInput(['autofocus' => true, 'placeholder' => 'Nama', 'required' => true])->label(false) ?>

                    <?= $form->field($model, 'email', ['template' => '
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                {input}
                            </div>
                        {error}{hint}
                    '])->textInput(['placeholder' => 'Email', 'required' => true])->label(false) ?>

                    <?= $form->field($model, 'password', ['template' => '
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-lock"></i>
                                </span>
                                {input}
                            </div>
                        {error}{hint}
                    '])->passwordInput(['placeholder' => 'Password', 'required' => true])->label(false) ?>

                    <?= Html::submitButton('SIGN-UP', ['class' => 'btn btn-submit btn-block', 'name' => 'login-button']) ?>

                    <p style="font-size:14px;color: rgb(235, 235, 235);margin-top: 0.5rem;margin-bottom: 0px" class="text-center">Wanna go back? &nbsp;<a href="<?= \yii\helpers\Url::to(['/']) ?>" class="text-warning">Yes</a></p>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>