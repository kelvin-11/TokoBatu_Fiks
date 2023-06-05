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

<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card" style="background-color: #7fad39;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card" style="background-color: #2c1608">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <?php if ($model->flag) : ?>
                                                    <img src="<?= \Yii::$app->request->BaseUrl . "/upload/" . $model->toko->flag ?>" alt="" id="profil" class="ms-1">
                                                <?php else : ?>
                                                    <img src="https://i.pinimg.com/736x/d9/7b/bb/d97bbb08017ac2309307f0822e63d082.jpg" alt="" id="profil" class="ms-1">
                                                <?php endif ?>
                                            </div>
                                            <div class="col-lg-8">
                                                <h5 class="fw-bold text-light mt-1"><b><?= $model->name ?></b></h5>
                                                <p class="fw-medium text-info mt-1"><b>Daftar Pada : </b><?= date('d M Y', strtotime($model->created_at)) ?></p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ms-3 mt-2">
                                    <h5 class="fw-bold text-light"><b>No Whatsapp :</b></h5>
                                    <h6 class="text-medium text-light ms-1 mt-1"><?= $model->no_whatsapp ?></h6>
                                    <h5 class="fw-bold text-light mt-2"><b>Alamat :</b></h5>
                                    <h6 class="text-medium text-light ms-1 mt-1"><?= $model->alamat ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="ms-3 mt-2">
                                    <h5 class="fw-bold text-light"><b>Tentang Toko Kami :</b></h5>
                                    <h6 class="text-medium text-light ms-1 mt-1"><?= $model->deskripsi ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-4" style="background-color: #7fad39;;">
                    <div class="card-body">
                        <div class="section-title product__discount__title text-center">
                            <div class="row">
                                <div class="col-lg-12 mt-2">
                                    <h2 class="text-light">Produk Toko</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($query as $p) {
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
        </div>
    </div>
</section>