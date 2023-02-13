<?php

use app\assets\AppAsset;
use app\models\Pesanan;
use app\models\PesananDetail;

if (Yii::$app->user->identity) {
    $pesanan = Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
    if ($pesanan != null) {
        $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
    }
}

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= yii::$app->name ?></title>
    <?php $this->head() ?>
</head>

<body onload=getDataPenjualan()>
    <?php $this->beginBody() ?>
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?= Yii\helpers\Url::to(['index']) ?>"><img src="<?= Yii\helpers\Url::to(['ogani-master/img/logo.png/']) ?>" alt=""></a>
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
                            <li><a href="#">About</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart mx-3">
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart me-1"></i> <span class="me-2 mx-1">?</span></a></li> -->
                            <?php if (Yii::$app->user->identity) : ?>
                                <?php if ($pesanan != null) : ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['/site/keranjang', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-shopping-bag me-2"></i> <span class="mx-1"><?= $pesanan_detail ?></span></a></li>
                                <?php else : ?>
                                    <li><a href="<?= \yii\helpers\Url::to(['/site/keranjang', 'id' => Yii::$app->user->identity->id]) ?>"><i class="fa fa-shopping-bag"></i></a></li>
                                <?php endif ?>
                            <?php else : ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>"><i class="fa fa-shopping-bag"></i></a></li>
                            <?php endif ?>
                            <?php if (yii::$app->user->identity) : ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>" class="text-dark fw-bold"><i class="fa fa-user mx-2"></i>Profil</a></li>
                            <?php else : ?>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/login']) ?>" class="text-dark fw-bold ml-2">Login</a></li>
                                <li><a href="<?= \yii\helpers\Url::to(['/login/signup']) ?>" class="text-dark fw-bold">Signup</a></li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <?= $content ?>

    <!-- <footer class="footer spad"> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.html"><img src="<?= \Yii::$app->request->BaseUrl ?>/ogani-master/img/logo.png" alt=""></a>
                        <p>Toko Online Dari Kota Batu</p>
                    </div>
                    <h5 class="fw-bold mb-3">MENJADI PENJUAL :</h5>
                    <a href="<?= yii\helpers\Url::to(['toko/register-toko']) ?>" type="button" class="site-btn text-light">Daftar Sekarang</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6 class="fw-bold">Informasi Kontak</h6>
                    <ul>
                        <li class="fw-bolder">Alamat :</li>
                        <li>Ruko Mayang Sari Balai Desa Pesanggrahan Kota Batu</li>
                        <li class="fw-bolder">Telp :</li>
                        <li>.</li>
                        <li class="fw-bolder">Email :</li>
                        <li>tokobatu@gmail.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6 class="fw-bold">Akun Saya</h6>
                    <a href="<?= Yii\helpers\Url::to(['login/login']) ?>">
                        <h6 class="fw-light py-1">Login</h6>
                    </a>
                    <a href="<?= \yii\helpers\Url::to(['profil/history']) ?>">
                        <h6 class="fw-light py-1">History Pesanan</h6>
                    </a>
                    <h6 class="fw-bold">Sosial Media Kami</h6>
                    <div class="footer__widget__social mt-3">
                        <a href="#" style="border-color: green;"><i class="fa-brands fa-facebook fa-lg"></i></a>
                        <a href="#" style="border-color: green;"><i class="fa-brands fa-instagram fa-lg"></i></a>
                        <a href="#" style="border-color: green;"><i class="fa-brands fa-twitter fa-lg"></i></a>
                        <a href="#" style="border-color: green;"><i class="fa-brands fa-pinterest fa-lg"></i></a>
                        <a href="#" style="border-color: green;"><i class="fa-brands fa-whatsapp fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> Toko Batu | Kota Batu <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Kelvin R.S</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                    </div>
                    <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>
<?= $this->render('ajax') ?>

</html>
<?php $this->endPage() ?>