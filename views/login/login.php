<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<section>
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
    <div class="box">
        <div class="square" style="--i:0;"></div>
        <div class="square" style="--i:1;"></div>
        <div class="square" style="--i:2;"></div>
        <div class="square" style="--i:3;"></div>
        <div class="square" style="--i:4;"></div>
        <div class="container">
            <div class="form">
                <h2>Login Form</h2>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                ]); ?>

                <?= $form->field($model, 'email', ['template' => '
                            <div class="inputBox">
                                {input}
                            </div>
                        {error}{hint}
                    '])->textInput(['autofocus' => true, 'placeholder' => 'Email', 'required' => true, 'type' => 'email'])->label(false) ?>

                <?= $form->field($model, 'password', ['template' => '
                            <div class="inputBox">
                                {input}
                            </div>
                        {error}{hint}
                    '])->passwordInput(['placeholder' => 'Password', 'required' => true])->label(false) ?>

                <!-- <div class="inputBox">
                        <input type="password" placeholder="Password">
                    </div> -->

                <div class="inputBox">
                    <?= Html::submitButton('LOGIN', ['class' => 'button']) ?>
                </div>
                <p class="forget">Don't have an account? <a href="<?= \yii\helpers\Url::to(['/login/signup']) ?>">Signup</a></p>
                <p class="forget">Wanna go back? <a href="<?= \yii\helpers\Url::to(['/']) ?>">Yes</a></p>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>