<?php

use yii\helpers\Url;

?>
<div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat item">
    <div class="featured__item" style="background-color:#f5f5f5;">
        <div class="featured__item__pic set-bg">
            <img src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="">
            <ul class="featured__item__pic__hover">
                <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $model->id ?>">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="produk_id" value="<?= $model->id ?>">
                    <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                    <li><a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $model->id]) ?>"><i class="fa fa-eye"></i></a></li>
                    <?php if ($model->stok != null) : ?>
                        <li><a onclick="document.querySelector('#keranjang<?= $model->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a></li>
                    <?php else : ?>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    <?php endif ?>
                </form>
            </ul>
        </div>
        <div class="featured__item__text">
            <h4 class="fw-bold"><?= $model->name ?></h4>
            <span class="fw-light fs-6"><?= $model->category->name ?></span>
            <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($model->harga) ?></h5>
        </div>
    </div>
</div>