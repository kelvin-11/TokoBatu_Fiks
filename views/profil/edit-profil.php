<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 text-center">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Profil</h6>
    </div>
    <div class="card-body">
        <?php

        use yii\bootstrap5\ActiveForm;
        use yii\helpers\Html;

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
                )->textInput(['maxlength' => true, 'class' => 'border-dark form-control'])->label('Nama Pengguna', ['class' => 'fw-bold text-dark ms-1']) ?>
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
                )->textInput(['maxlength' => true, 'type' => 'email', 'class' => 'border-dark form-control'])->label('Email', ['class' => 'fw-bold text-dark ms-1']) ?>
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
                )->textInput(['maxlength' => true, 'type' => 'number', 'class' => 'border-dark form-control'])->label('No.Hp', ['class' => 'fw-bold text-dark ms-1']) ?>
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
                )->textarea(['rows' => '3', 'class' => 'border-dark form-control'])->label('Alamat', ['class' => 'fw-bold text-dark ms-1']) ?>
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
                    'class' => 'border-dark form-control'
                ])->label('Foto Profil', ['class' => 'fw-bold text-dark ms-1']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4" style="text-align:center">
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn bg-gradient-success text-light']); ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>