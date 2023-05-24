<?php

use app\models\Favorit;
use app\models\Pesanan;
use app\models\PesananDetail;

if (Yii::$app->user->identity) {
    $favorit = Favorit::find()->where(['user_id' => Yii::$app->user->identity->id])->count();
    $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
    if ($pesanan != null) {
        $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
    }
}
?>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo text-center">
        <a href="<?= Yii\helpers\Url::to(['index']) ?>"><img src="<?= Yii\helpers\Url::to(['img/logo-toko.png']) ?>" alt="" style="width: 80px;height:80px;"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <?php if (Yii::$app->user->identity) : ?>
                <li><a href="<?= \yii\helpers\Url::to(['/profil/favorit', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-heart me-2"></i> <span class="mx-1"><?= number_format($favorit) ?></span></a></li>
                <li><a href="<?= \yii\helpers\Url::to(['/site/keranjang', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-shopping-bag me-2"></i> <?php if ($pesanan) { ?><span class="mx-1"><?= number_format($pesanan_detail) ?></span><?php } ?></a></li>
            <?php else : ?>
                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>"><i class="fa fa-heart"></i></a></li>
                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>"><i class="fa fa-shopping-bag"></i></a></li>
            <?php endif ?>
        </ul>
        <div class="header__cart__price"><span>item:</span>
            <?php if (Yii::$app->user->identity) : ?>
                <?php if ($pesanan != null) : ?>
                    <span>Rp. <?= $pesanan->total_harga ?></span>
                <?php endif ?>
            <?php else : ?>
                <span>Rp. 0</span>
            <?php endif ?>
        </div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <div>Indonesia</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Indonesia</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <?php if (yii::$app->user->identity) : ?>
                <a href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>" class="fw-bold"><i class="fa fa-user"></i> Profil</a>
            <?php else : ?>
                <a href="<?= \yii\helpers\Url::to(['/login/login']) ?>" class="fw-bold"><i class="fa-solid fa-door-open"></i> Login</a>
            <?php endif ?>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Home</a></li>
            <li><a href="<?= \yii\helpers\Url::to(['/site/shop']) ?>">Barang</a></li>
            <!-- <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li> -->
            <li><a href="<?= \yii\helpers\Url::to(['/site/about']) ?>">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#" style="border-color: green;"><i class="fa-brands fa-facebook fa-lg"></i></a>
        <a href="#" style="border-color: green;"><i class="fa-brands fa-instagram fa-lg"></i></a>
        <a href="#" style="border-color: green;"><i class="fa-brands fa-twitter fa-lg"></i></a>
        <a href="#" style="border-color: green;"><i class="fa-brands fa-pinterest fa-lg"></i></a>
        <a href="#" style="border-color: green;"><i class="fa-brands fa-whatsapp fa-lg"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> tokobatu@gmail.com</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo text-center">
                    <a href="<?= Yii\helpers\Url::to(['index']) ?>"><img src="<?= Yii\helpers\Url::to(['img/logo-toko.png']) ?>" alt="" style="width: 70px;height:70px;"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li><a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">Home</a></li>
                        <li><a href="<?= \yii\helpers\Url::to(['/site/shop']) ?>">Barang</a></li>
                        <!-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                        <li><a href="<?= \yii\helpers\Url::to(['/site/about']) ?>">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart mx-3">
                    <div class="header__top" style="background-color: white;">
                        <ul>
                            <?php if (Yii::$app->user->identity) : ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/profil/favorit', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-heart me-2"></i> <span class="mx-1"><?= number_format($favorit) ?></span></a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/site/keranjang', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-shopping-bag me-2"></i> <?php if ($pesanan) { ?><span class="mx-1"><?= number_format($pesanan_detail) ?></span><?php } ?></a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>" class="text-dark fw-bold"><i class="fa fa-user mx-2"></i>Profil</a></li>
                            <?php else : ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>"><i class="fa fa-heart"></i></a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>" class="text-dark fw-bold ml-2">Login</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/signup']) ?>" class="text-dark fw-bold">Signup</a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->