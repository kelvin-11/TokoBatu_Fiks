<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="card bg-warning" style="border-radius: 4%;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php
                                    $foto = Yii::$app->user->identity->img;
                                    if ($foto == null) {
                                    ?>
                                        <img class="border-r10 shadow-br3 mt-3" src="<?= \Yii::$app->request->BaseUrl ?>/ogani-master/img/logo.png" width="100px" height="100px">
                                    <?php } else { ?>
                                        <img class="border-r10 shadow-br3 mt-3 border border-success" src="<?= \Yii::$app->request->BaseUrl . '/upload/' . $data->img ?>" width="100px" height="100px" style="border-radius: 50%;">
                                    <?php } ?>
                                </div>
                                <div class="col-lg-7">
                                    <h6 class="font-weight-bold mb-3" style="padding-top: 12%;"><?= Yii::$app->user->identity->name ?></h6>
                                    <p class="font-weight-bold"><a href="<?= yii\helpers\Url::to(['profil/edit-profil', 'id' => $data->id]) ?>" class="text-dark fw-bold"><i class="fas fa-edit fa-lg"></i> Edit</a></p>
                                </div>
                                <hr class="text-warning fw-bold">
                                <div class="col-lg-12 text-right border-top-2 mt-2 pt-4">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr class="border-bottom-3">
                                                <td class="text-left w-10"><i class="fa-solid fa-house-user fa-lg"></i></td>
                                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>">Beranda</a></td>
                                            </tr>
                                            <tr class="border-bottom-3">
                                                <td class="text-left w-10"><i class="fa-solid fa-file fa-lg"></i></td>
                                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/profil/history', 'id' => yii::$app->user->identity->id]) ?>">History Pembelian</a></td>
                                            </tr>
                                            <!-- <tr class="border-bottom-3">
                                                <td class="text-left w-10"><i class="fa-sharp fa-solid fa-heart fa-lg"></i></td>
                                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="">Wishlist</a></td>
                                            </tr> -->
                                            <tr class="border-bottom-3">
                                                <td class="text-left w-10"><i class="fa-solid fa-shop fa-lg"></i></td>
                                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/toko/register-toko', 'id' => yii::$app->user->identity->id]) ?>">Membuat Toko</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                    <div class="card bg-warning" style="border-radius: 4%">
                        <h4 class="text-isalam-1 font-weight-bold text-detail-program text-center mt-3">Membuat Toko</h4>
                        <div class="card-body">
                            <?= $this->render('_form-register-toko', [
                                'model' => $model,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>