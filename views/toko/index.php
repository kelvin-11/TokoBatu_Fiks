<?php

use yii\helpers\Url;

?>
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card bg-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <img src="<?= \Yii::$app->request->BaseUrl . "/upload/" . $model->flag ?>" alt="" style="width: 80px;height: 80px;border-radius: 50%" class="ms-2 border border-warning">
                                            </div>
                                            <div class="col-lg-8">
                                                <h5 class="fw-bold text-light mt-1"><b><?= $model->name ?></b></h5>
                                                <p class="fw-medium text-warning mt-1"><b>Daftar Pada : </b><?= date('y-m-d', strtotime($model->created_at)) ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ms-3 mt-2">
                                    <h5 class="fw-bold">No Whatsapp :</h5>
                                    <h6 class="text-medium ms-1 mt-1"><?= $model->no_whatsapp ?></h6>
                                    <h5 class="fw-bold mt-2">Alamat :</h5>
                                    <h6 class="text-medium ms-1 mt-1"><?= $model->alamat ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ms-3 mt-2">
                                    <h5 class="fw-bold">Tentang Toko Kami :</h5>
                                    <h6 class="text-medium ms-1 mt-1"><?= $model->deskripsi ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-5 bg-warning">
                    <div class="card-body">
                        <div class="section-title product__discount__title text-center">
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-2">
                                    <h2>Produk Toko</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($query as $p) { ?>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item" style="background-color:#f5f5f5;">
                                        <div class="product__item__pic set-bg" data-setbg="">
                                            <img src="<?= Url::to(['/upload/' . $p->img]) ?>" alt="">
                                            <ul class="product__item__pic__hover">
                                                <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $p->id ?>">
                                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $p->id ?>">
                                                    <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                                    <li><a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $p->id]) ?>"><i class="fa fa-eye"></i></a></li>
                                                    <?php if ($p->stok != null) : ?>
                                                        <li><a onclick="document.querySelector('#keranjang<?= $p->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a></li>
                                                    <?php else : ?>
                                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                    <?php endif ?>
                                                </form>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h4 class="fw-bold"><?= $p->name ?></h4>
                                            <span class="fw-light fs-6"><?= $p->category->name ?></span>
                                            <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($p->harga) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="product__pagination d-flex justify-content-center">
                            <?php echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pagination,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>