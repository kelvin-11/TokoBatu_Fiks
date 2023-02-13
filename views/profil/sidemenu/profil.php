<div class="card bg-warning" style="border-radius: 4%;">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5">
                <?php
                $foto = Yii::$app->user->identity->img;
                if ($foto == null) {
                ?>
                    <img class="border-r10 shadow-br3 mt-3" src="<?= \Yii::$app->request->BaseUrl ?>/ogani-master/img/logo.png" width="100px" height="100px">
                <?php } else { ?>
                    <img class="border-r10 shadow-br3 mt-3 border border-success" src="<?= \Yii::$app->request->BaseUrl . '/upload/' . $model->img ?>" width="100px" height="100px" style="border-radius: 50%;">
                <?php } ?>
            </div>
            <div class="col-lg-7">
                <h6 class="font-weight-bold mb-3" style="padding-top: 12%;"><?= Yii::$app->user->identity->name ?></h6>
                <p class="font-weight-bold"><a href="<?= \yii\helpers\Url::to(['/profil/edit-profil', 'id' => yii::$app->user->identity->id]) ?>" class="text-dark fw-bold"><i class="fas fa-edit fa-lg"></i> Edit</a></p>
                <form action="<?= \yii\helpers\Url::to(['login/logout']) ?>" method="POST" id="logout">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                </form>
                <button class="dropdown-item font-weight-bold" onclick="document.querySelector('#logout').submit()"><i class="fa-sharp fa-solid fa-right-from-bracket fa-lg"></i> Logout</button>
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
                        <?php if ($identy->role_id != 3) : ?>
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