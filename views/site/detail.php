<?php

use yii\helpers\Url;

?>
<style>
    .sale-off {
        height: 55px;
        width: 55px;
        background: #dd2222;
        border-radius: 50%;
        font-size: 14px;
        color: #ffffff;
        line-height: 55px;
        text-align: center;
        position: absolute;
        left: 20px;
        top: 20px;
    }

    #profil {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 8px;
        background: linear-gradient(135deg, red, blue 50%, transparent 50%);
        background-size: 250%;
        background-position: 100% 100%;
        transition: background 0.5s;
    }

    #profil:hover {
        background-position: 0% 0%;
    }
</style>

<!-- Breadcrumb Section Begin -->
<div class="container">
    <div class="row">
        <section class="breadcrumb-section" style="background-color: #7fad39;" data-setbg="">
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
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="product__details__pic">
                <img class="product__details__pic__item" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 555px;height: 460px;">
            </div>
            <div class="product__details__pic__slider owl-carousel">
                <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
                <img data-imgbigurl="" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
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
                <div class="product__details__price">
                    <?php if ($promo) :
                        $value = $promo->nilai;
                        $percentVal = round(($value / $model->harga) * 100, 2);
                    ?>
                        Rp. <?= number_format($model->harga - $promo->nilai) ?>
                        <p class="mb-0 text-muted"><del>Rp. <?= number_format($model->harga) ?></del> <b class="text-danger">Hemat Hingga <?= $percentVal ?>%</b></p>
                    <?php else : ?>
                        Rp. <?= number_format($model->harga) ?>
                    <?php endif ?>
                </div>
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
                        <li class="text-danger fw-bold"><b>Stok Produk :</b> <span>TERJUAL HABIS</span></li>
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
                <div class="card mt-3" style="background-color: #7fad39;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2" style="text-align: center;">
                                <?php if ($model->toko->flag) : ?>
                                    <img src="<?= \Yii::$app->request->BaseUrl . "/upload/" . $model->toko->flag ?>" alt="" id="profil">
                                <?php else : ?>
                                    <img src="https://i.pinimg.com/736x/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" alt="" id="profil">
                                <?php endif ?>
                            </div>
                            <div class="col-lg-3" style="text-align: center;">
                                <h5 class="text-light"><b><?= $model->toko->name ?></b></h5>
                                <div class="card mt-3 border border-success">
                                    <div class="card-body bg-light">
                                        <h5 class="text-center"><a href="<?= \Yii::$app->request->baseUrl . "/site/toko-view?toko=" . $model->toko->name ?>" <?php
                                                                                                                                                                if (isset($_GET['toko']) == $model->toko->name) {
                                                                                                                                                                    echo "selected";
                                                                                                                                                                }
                                                                                                                                                                ?> class=" text-success"><b><i class="fa-solid fa-shop fa-lg me-3"></i>Lihat Toko</b></a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h5 class="text-light"><b>No Whatsapp :</b></h5>
                                <h6 class="text-medium ms-1 mt-1 text-light"><?= $model->toko->no_whatsapp ?></h6>
                                <h5 class="mt-2 text-light"><b>Alamat :</b></h5>
                                <h6 class="text-medium ms-1 mt-1 text-light"><?= $model->toko->alamat ?></h6>
                            </div>
                            <div class="col-lg-4">
                                <h5 class="text-light"><b>Tentang Toko Kami :</b></h5>
                                <h6 class="text-medium ms-1 mt-1 text-light"><?= $model->toko->deskripsi ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xs-12 col-lg-12">
                <div class="card mt-3" style="background-color: #7fad39;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-xs-10">
                                <h3 class="text-light"><b>PRODUK TERKAIT</b></h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-2">
                                <h5><a href="<?= \Yii::$app->request->baseUrl . "/site/toko-view?toko=" . $model->toko->name ?>" <?php
                                                                                                                                    if (isset($_GET['toko']) == $model->toko->name) {
                                                                                                                                        echo "selected";
                                                                                                                                    }
                                                                                                                                    ?> class="text-light"><b><i class="fa fa-eye"></i> Lihat Lainnya</b></a></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <?php foreach ($produk as $p) {
                                $promo = app\models\Promo::find()->where(['products_id' => $p->id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
                            ?>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item" style="background-color:#f5f5f5;">
                                        <div class="product__item__pic set-bg" data-setbg="">
                                            <img src="<?= Url::to(['/upload/' . $p->img]) ?>" alt="">
                                            <?php if ($p->stok == null || 0) { ?>
                                                <div class="sale-off">sale out</div>
                                            <?php } ?>
                                            <ul class="product__item__pic__hover">
                                                <form action="<?= Yii::$app->request->baseUrl . "/site/create-favorit" ?>" method="post" id="favorit<?= $p->id ?>">
                                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $p->id ?>">
                                                </form>
                                                <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $p->id ?>">
                                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $p->id ?>">
                                                </form>
                                                <li><a onclick="document.querySelector('#favorit<?= $p->id ?>').submit()"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $p->id]) ?>"><i class="fa fa-eye"></i></a></li>
                                                <?php if ($p->stok != null) : ?>
                                                    <li><a onclick="document.querySelector('#keranjang<?= $p->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a></li>
                                                <?php else : ?>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h4 class="fw-bold"><?= $p->name ?></h4>
                                            <span class="fw-light fs-6"><?= $p->category->name ?></span>
                                            <?php if ($promo) : ?>
                                                <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($p->harga - $promo->nilai) ?></h5>
                                            <?php else : ?>
                                                <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($p->harga) ?></h5>
                                            <?php endif ?>
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