<?php

use yii\helpers\Url;

?>
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item" id="select-category">
                        <h4>Kategori</h4>
                        <ul>
                            <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop/" ?>">Semua Kategory</a></li>
                            <?php foreach ($categories as $category) { ?>
                                <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop?category=" . $category->name ?>" <?php
                                                                                                                                if (isset($_GET['category']) == $category->name) {
                                                                                                                                    echo "selected";
                                                                                                                                }
                                                                                                                                ?>><?= $category->name ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Produk Terbaru</h4>
                            <div class="latest-product__slider owl-carousel">
                                <?php foreach ($lates as $l) { ?>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $l->id]) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?= Url::to(['/upload/' . $l->img]) ?>" alt="" style="width: 110px;">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h5 class="fw-bold"><?= $l->name ?></h4 class="fw-bold">
                                                </h5>
                                                <h6 class="py-2 mt-1">Rp. <?= number_format($l->harga) ?></h6>
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
                <div class="hero__search mb-5">
                    <div class="hero__search__form">
                        <form action="#">
                            <input type="text" name="search" id="search" placeholder="Apa yang kamu butuhkan?">
                            <button class="site-btn"><i class="fa fa-search fa-lg"></i></button>
                        </form>
                    </div>
                </div>

                <!-- <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Sale Off</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-1.jpg">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span>Dried Fruit</span>
                                        <h5><a href="#">Raisin’n’nuts</a></h5>
                                        <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="section-title product__discount__title">

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">

                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row" id="template">
                    <?php foreach ($model as $mdl) : ?>
                        <?= $this->render('_items', ['model' => $mdl]); ?>
                    <?php endforeach ?>
                </div>
                <div class="product__pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
//category
$script = <<< JS
$(document).ready(function () {
    $("#select-category").change(function() {
        window.location.href = $(this).val();
    });
});
JS;
$this->registerJs($script);
?>