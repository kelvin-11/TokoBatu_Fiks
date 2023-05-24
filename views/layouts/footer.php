<!-- <footer class="footer spad"> -->
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer__about text-center">
                <div class="footer__about__logo">
                    <a href="./index.html"><img src="<?= \Yii::$app->request->BaseUrl ?>/img/logo-toko.png" alt="" style="width: 70px;height: 70px"></a>
                    <p><b>Toko Online Dari Kota Batu</b></p>
                </div>
                <h5 class="fw-bold mb-2">MENJADI PENJUAL :</h5>
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
                <?php if (Yii::$app->user->identity) : ?>
                    <a href="<?= Yii\helpers\Url::to(['profil/profil']) ?>">
                        <h6 class="fw-light py-1"><?= Yii::$app->user->identity->email ?></h6>
                    </a>
                    <a href="<?= \yii\helpers\Url::to(['profil/history']) ?>">
                        <h6 class="fw-light py-1">History Pesanan</h6>
                    </a>
                <?php else : ?>
                    <a href="<?= Yii\helpers\Url::to(['login/login']) ?>">
                        <h6 class="fw-light py-1">Login</h6>
                    </a>
                <?php endif ?>
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
</div>