<?php

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
<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <?= $this->render('sidemenu/profil', [
                        'model' => $model,
                        'identy' => $identy
                    ]);
                    ?>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                    <h3 class="text-isalam-1 font-weight-bold text-detail-program"></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card bg-warning">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?php if ($pesanan != null) : ?>
                                                <h4 class="fw-bold"><?= $keranjang ?></h4>
                                            <?php else : ?>
                                                <h4 class="fw-bold">0</h4>
                                            <?php endif ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="fw-bold">Produk</h4>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="ms-5 mb-4">Di Keranjang Anda</h6>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card bg-warning">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="fw-bold"><?= $history ?></h4>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="fw-bold">Pesanan</h4>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="ms-5 mb-4">Di History Pembelian Anda</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mt-5 bg-warning">
                                <div class="card-body">
                                    <h3 class="fw-bold">Pemesanan :</h3>
                                    <hr style="border-color: black;">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h5>Pesanan berhasil</h5>
                                            <h5 class="mt-4">Pesanan diorder</h5>
                                            <h5 class="mt-4">Pesanan dikonfirmasi</h5>
                                            <h5 class="mt-4">Pesanan dalam perjalanan</h5>
                                            <h5 class="mt-4">Pesanan gagal</h5>
                                            <h5 class="mt-4">Total pesanan</h5>
                                        </div>
                                        <div class="col-lg-2">
                                            <h5><?= $berhasil ?></h5>
                                            <h5 class="mt-4"><?= $pending ?></h5>
                                            <h5 class="mt-4"><?= $dikonfirmasi ?></h5>
                                            <h5 class="mt-4"><?= $dalamperjalanan ?></h5>
                                            <h5 class="mt-4"><?= $gagal ?></h5>
                                            <h5 class="mt-4"><?= $history + $pending ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>