<div class="card bg-warning" style="border-radius: 4%;">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5">
                <?php
                $foto = $data->flag;
                if ($foto == null) {
                ?>
                    <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/ogani-master/img/logo.png" width="100px" height="100px" style="border-radius: 50%;">
                <?php } else { ?>
                    <img class="border-r10 shadow-br3 border border-success" src="<?= \Yii::$app->request->BaseUrl . '/upload/' . $data->flag ?>" width="100px" height="100px" style="border-radius: 50%;">
                <?php } ?>
            </div>
            <div class="col-lg-7">
                <h6 class="font-weight-bold mb-3" style="padding-top: 12%;"><?= $data->name ?></h6>
                <p class="font-weight-bold mt-3"><a href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id])?>" class="text-dark gw-bold"><i class="fas fa-user"></i> <?= Yii::$app->user->identity->name ?></a></p>
            </div>
            <hr class="text-warning fw-bold">
            <div class="col-lg-12 text-right border-top-2 mt-2 pt-4">
                <table class="table table-borderless">
                    <tbody>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fa-solid fa-house-user fa-lg"></i></td>
                            <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>">Beranda</a></td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fa-solid fa-file fa-lg"></i></td>
                            <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/profil/history', 'id' => yii::$app->user->identity->id]) ?>">History Pembelian</a></td>
                        </tr>
                        <!-- <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fa-sharp fa-solid fa-heart fa-lg"></i></td>
                            <td class="text-left"><a class="text-dark me-5 fw-bold" href="">Wishlist</a></td>
                        </tr> -->
                        <?php if ($data->id_user == null) : ?>
                            <tr class="border-bottom-3">
                                <td class="text-left w-10"><i class="fa-solid fa-shop fa-lg"></i></td>
                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/toko/register-toko', 'id' => yii::$app->user->identity->id]) ?>">Membuat Toko</a></td>
                            </tr>
                        <?php else : ?>
                            <tr class="border-bottom-3">
                                <td class="text-left w-10"><i class="fa-solid fa-shop fa-lg"></i></td>
                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/toko/beranda-toko', 'id' => yii::$app->user->identity->id]) ?>">Toko</a></td>
                            </tr>
                            <tr class="border-bottom-3">
                                <td class="text-left w-10"><i class="fa-solid fa-store fa-lg"></i></td>
                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/toko/toko-produk', 'id' => yii::$app->user->identity->id]) ?>">Produk</a></td>
                            </tr>
                            <tr class="border-bottom-3">
                                <td class="text-left w-10"><i class="fa-solid fa-gear fa-lg"></i></td>
                                <td class="text-left"><a class="text-dark me-5 fw-bold" href="<?= \yii\helpers\Url::to(['/toko/pengaturan-toko', 'id' => yii::$app->user->identity->id]) ?>">Pengaturan Toko</a></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>