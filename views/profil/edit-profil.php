<hr class="mt-0">
<div class="container pb-20">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('sidemenu/profil', [
                'model' => $model,
                'identy' => $identy
            ]) ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <div class="card mb-5 bg-warning" style="border-radius: 4%">
                <div class="card-body">
                    <h3 class="text-isalam-1 font-weight-bold text-detail-program mt-2 mb-4 text-center">Edit Profile</h3>
                    <?php

                    use yii\bootstrap5\ActiveForm;
                    use yii\helpers\Html;
                    use yii\helpers\Url;

                    $form = ActiveForm::begin([
                        'id' => 'user',
                        'layout' => 'horizontal',
                        'enableClientValidation' => true,
                        'enableClientScript' => false,
                    ]);
                    ?>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <?= $form->field(
                                $model,
                                'name',
                                [
                                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                                    'inputOptions' => [
                                        'class' => 'form-control'
                                    ],
                                    'labelOptions' => [
                                        'class' => 'control-label'
                                    ],
                                    'options' => ['tag' => false]
                                ]
                            )->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <?= $form->field(
                                $model,
                                'email',
                                [
                                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                                    'inputOptions' => [
                                        'class' => 'form-control'
                                    ],
                                    'labelOptions' => [
                                        'class' => 'control-label'
                                    ],
                                    'options' => ['tag' => false]
                                ]
                            )->textInput(['maxlength' => true, 'type' => 'email']) ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                            <?= $form->field(
                                $model,
                                'no_hp',
                                [
                                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                                    'inputOptions' => [
                                        'class' => 'form-control'
                                    ],
                                    'labelOptions' => [
                                        'class' => 'control-label'
                                    ],
                                    'options' => ['tag' => false]
                                ]
                            )->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                            <?= $form->field(
                                $model,
                                'alamat',
                                [
                                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                                    'inputOptions' => [
                                        'class' => 'form-control'
                                    ],
                                    'labelOptions' => [
                                        'class' => 'control-label'
                                    ],
                                    'options' => ['tag' => false]
                                ]
                            )->textarea(['rows' => '3']) ?>
                        </div>

                        <div class="col-md-12 col-12 mt-3">
                            <?= $form->field($model, 'img',  [
                                'template' => '
                            {label}
                            {input}
                            {error}
                        ',
                                'inputOptions' => [
                                    'class' => 'form-control'
                                ],
                                'labelOptions' => [
                                    'class' => 'control-label'
                                ],
                                'options' => ['tag' => false]
                            ])->fileInput([
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                                    'maxFileSize' => 250,
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <?php if ($model->img != null) : ?>
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                <img src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 350px;height: 250px;border-radius: 5%">
                            </div>
                            <div class="col-lg-6 col-md-offset-3 mt-4">
                                <div style="text-align:center">
                                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row">
                            <div class="col-md-offset-3 col-md-12 mt-4">
                                <div style="text-align:center">
                                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>