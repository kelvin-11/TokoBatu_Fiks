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
</style>
<div class="col-lg-4 col-md-6 col-sm-6 item">
    <div class="product__item" style="background-color:#f5f5f5;">
        <div class="product__item__pic set-bg" data-setbg="">
            <img src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
            <?php if ($model->stok == null || 0) { ?>
                <div class="sale-off">sale out</div>
            <?php } ?>
            <ul class="product__item__pic__hover">
                <form action="<?= Yii::$app->request->baseUrl . "/site/create-favorit" ?>" method="post" id="favorit<?= $model->id ?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="produk_id" value="<?= $model->id ?>">
                </form>
                <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $model->id ?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="produk_id" value="<?= $model->id ?>">
                </form>
                <li><a onclick="document.querySelector('#favorit<?= $model->id ?>').submit()"><i class="fa fa-heart"></i></a></li>
                <li><a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $model->id]) ?>"><i class="fa fa-eye"></i></a></li>
                <?php if ($model->stok != null) : ?>
                    <li><a onclick="document.querySelector('#keranjang<?= $model->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a></li>
                <?php else : ?>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                <?php endif ?>
            </ul>
        </div>
        <div class="product__item__text">
            <h4 class="fw-bold fs-4"><?= $model->name ?></h4>
            <span class="fw-light fs-6"><?= $model->category->name ?></span>
            <?php if ($promo) : ?>
                <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($model->harga - $promo->nilai) ?></h5>
            <?php else : ?>
                <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($model->harga) ?></h5>
            <?php endif ?>
        </div>
    </div>
</div>