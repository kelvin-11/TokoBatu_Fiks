<?php

use yii\helpers\Url;

?>
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item" id="select-category">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>KATEGORI</span>
                            </div>

                            <ul style="height: 450px; overflow: auto">
                                <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop/" ?>">Semua Kategori</a></li>
                                <?php foreach ($categories as $category) { ?>
                                    <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop?category=" . rawurlencode($category->name) ?>" <?php
                                                                                                                                                if (isset($_GET['category']) == $category->name) {
                                                                                                                                                    echo "selected";
                                                                                                                                                }
                                                                                                                                                ?>><?= $category->name ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>TERBARU</h4>
                            <div class="latest-product__slider owl-carousel">
                                <?php foreach ($lates as $l) {
                                    $promo = app\models\Promo::find()->where(['products_id' => $l->id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
                                ?>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $l->id]) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?= Url::to(['/upload/' . $l->img]) ?>" alt="" style="width: 110px;">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h5 class="fw-bold"><?= $l->name ?></h5>
                                                <?php if ($promo) : ?>
                                                    <h6 class="py-2 mt-1">Rp. <?= number_format($l->harga - $promo->nilai) ?></h6>
                                                <?php else : ?>
                                                    <h6 class="py-2 mt-1">Rp. <?= number_format($l->harga) ?></h6>
                                                <?php endif ?>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>DISKON</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <?php foreach ($diskon as $mdl) :
                                $value = $mdl->nilai;
                                $percentVal = round(($value / $mdl->products->harga) * 100, 2);
                            ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg" data-setbg="">
                                            <img src="<?= Url::to(['/upload/' . $mdl->products->img]) ?>" alt="">
                                            <div class="product__discount__percent"><?= $percentVal ?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <form action="<?= Yii::$app->request->baseUrl . "/site/create-favorit" ?>" method="post" id="favorit<?= $mdl->products->id ?>">
                                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $mdl->products->id ?>">
                                                </form>
                                                <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $mdl->products->id ?>">
                                                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                                                    <input type="hidden" name="produk_id" value="<?= $mdl->products->id ?>">
                                                </form>
                                                <li><a onclick="document.querySelector('#favorit<?= $mdl->products->id ?>').submit()"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $mdl->products->id]) ?>"><i class="fa fa-eye"></i></a></li>
                                                <?php if ($mdl->products->stok != null) : ?>
                                                    <li><a onclick="document.querySelector('#keranjang<?= $mdl->products->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a></li>
                                                <?php else : ?>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h4 class="fw-bold fs-4"><?= $mdl->products->name ?></h4>
                                            <span class="fw-light fs-6"><?= $mdl->products->category->name ?></span>
                                            <h5 class="fw-medium py-2 mb-1">Rp. <?= number_format($mdl->products->harga - $mdl->nilai) ?></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="section-title">
                    <h2>SEMUA PRODUK</h2>
                </div>
                <div class="hero__search mb-5">
                    <div class="hero__search__form" style="border-color: green;margin-left: 125px">
                        <form action="#">
                            <span class="ms-3 text-success"><i class="fa fa-search fa-lg"></i></span>
                            <input type="text" name="search" id="search" placeholder="Apa yang kamu butuhkan?">
                        </form>
                    </div>
                </div>
                <div class="row" id="template">
                    <?php foreach ($model as $mdl) :
                        $promo = app\models\Promo::find()->where(['products_id' => $mdl->id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
                    ?>
                        <?= $this->render('_items', ['model' => $mdl, 'promo' => $promo]); ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//Kategori
$script = <<< JS
$(document).ready(function () {
    $("#select-category").change(function() {
        window.location.href = $(this).val();
    });
});
JS;
$this->registerJs($script);
?>