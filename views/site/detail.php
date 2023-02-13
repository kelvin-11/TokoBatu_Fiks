<?php

use yii\helpers\Url;

?>
<!-- Breadcrumb Section Begin -->
<div class="container">
    <div class="row">
        <section class="breadcrumb-section bg-warning" data-setbg="">
            <div class="col-lg-12">
                <div class="breadcrumb__text text-center">
                    <h2 class="mb-2"><?= $model->name ?></h2>
                    <div class="breadcrumb__option">
                        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Home</a>
                        <span><a href="<?= \Yii::$app->request->baseUrl . "/site/shop?category=" . $model->category->name ?>"><?= $model->category->name ?></a></span>
                        <span class="fw-bold"><?= $model->name ?></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <img class="product__details__pic__item" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 555px;height: 470px;border-radius: 5%">
                </div>
                <div class="product__details__pic__slider owl-carousel">
                    <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                    <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                    <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                    <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-3">
                <div class="product__details__text">
                    <h3><?= $model->name ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(reviews)</span>
                    </div>
                    <div class="product__details__price">Rp. <?= number_format($model->harga) ?></div>
                    <p><?= $model->deskripsi_produk ?></p>

                    <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="hidden" name="produk_id" value="<?= $model->id ?>">
                        <input type="hidden" class="form-control stok" value="<?= $model->stok ?>">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="qty" id="1" type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="primary-btn border border-0 add" value="ADD TO CART">
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    </form>

                    <ul>
                        <?php if ($model->stok != null) : ?>
                            <li><b>Stok Produk :</b> <span><?= $model->stok ?></span></li>
                        <?php else : ?>
                            <li class="text-danger fw-bold"><b>Stok Produk :</b> <span>TIDAK TERSEDIA</span></li>
                        <?php endif ?>
                        <li><b>Berat Produk :</b><span><?= $model->berat ?> Gram</span></li>
                        <li><b>Bagikan Di :</b>
                            <div class="share">
                                <a href="#"><i class="fa-brands fa-facebook fa-lg"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter fa-lg"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram fa-lg"></i></a>
                                <a href="#"><i class="fa-brands fa-pinterest fa-lg"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php if ($model->toko_id != null) { ?>
                <div class="col-lg-12">
                    <div class="card mt-5 bg-warning">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <img src="<?= \Yii::$app->request->BaseUrl . "/upload/" . $model->toko->flag ?>" alt="" style="width: 100px;height: 100px;border-radius: 50%" class="ms-4">
                                </div>
                                <div class="col-lg-3">
                                    <h5 class="fw-bold"><?= $model->toko->name ?></h5>
                                    <div class="card mt-3 border border-success">
                                        <div class="card-body bg-dark">
                                            <h6 class="text-center"><a href="<?= \Yii::$app->request->baseUrl . "/toko/index?toko=" . $model->toko->name ?>" <?php
                                                                                                                                                                if (isset($_GET['toko']) == $model->toko->name) {
                                                                                                                                                                    echo "selected";
                                                                                                                                                                }
                                                                                                                                                                ?> class=" text-light"><i class="fa-solid fa-shop fa-lg me-3"></i>Lihat Toko</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="ms-5">
                                        <h5 class="fw-bold">No Whatsapp :</h5>
                                        <h6 class="text-medium ms-1 mt-1"><?= $model->toko->no_whatsapp ?></h6>
                                        <h5 class="fw-bold mt-2">Alamat :</h5>
                                        <h6 class="text-medium ms-1 mt-1"><?= $model->toko->alamat ?></h6>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="ms-3">
                                        <h5 class="fw-bold">Tentang Toko Kami :</h5>
                                        <h6 class="text-medium ms-1 mt-1"><?= $model->toko->deskripsi ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mt-5 bg-warning">
                        <div class="card-body">
                            <div class="section-title product__discount__title">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h2>Produk Terkait</h2>
                                    </div>
                                    <div class="col-lg-2">
                                        <h5><a href="<?= \Yii::$app->request->baseUrl . "/toko/index?toko=" . $model->toko->name ?>" <?php
                                                                                                                                        if (isset($_GET['toko']) == $model->toko->name) {
                                                                                                                                            echo "selected";
                                                                                                                                        }
                                                                                                                                        ?> class="text-dark fw-bold"><i class="fa fa-eye"></i> Lihat Lainnya</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php foreach ($produk as $p) { ?>
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
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>