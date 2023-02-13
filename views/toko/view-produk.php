<?php

use yii\helpers\Url;

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-5" style="background-color: #dee1e6;">
                <div class="bg-warning">
                    <h3 class="fw-bold mt-3 ms-4 mb-3">Detail Produk</h3>
                </div>
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="product__details__pic__item" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 350px;height: 400px;border-radius: 5%">
                        </div>
                        <div class="col-lg-8">
                            <h2><strong><?= $model->name ?></strong></h2>
                            <h5 class="mt-1">
                                <?php if ($model->stok != null) : ?>
                                    <span class="badge bg-success text-light"><i class="fas fa-check mx-1"></i>Stok : <?= $model->stok ?></span>
                                <?php else : ?>
                                    <span class="badge bg-danger text-light"><i class="fas fa-times mx-2"></i>Stok : <?= $model->stok ?></span>
                                <?php endif ?>
                            </h5>
                            <hr style="border-color: black;">
                            <div class="row">
                                <div class="col">
                                    <table class="table" style="border-top: hidden;">
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($model->harga) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td><?= $model->category->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berat Produk</td>
                                            <td>:</td>
                                            <td><?= $model->berat ?> Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Produk</td>
                                            <td>:</td>
                                            <td><?= $model->deskripsi_produk ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>