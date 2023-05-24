<?php

use yii\helpers\Url;

?>
<div class="card shadow mb-4">
    <div class="card-header py-3 text-center">
        <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 text-center">
                <img class="product__details__pic__item" src="<?= Url::to(['/upload/' . $model->img]) ?>" alt="" style="width: 300px;height: 300px;">
            </div>
            <div class="col-lg-8">
                <h3><strong><?= $model->name ?></strong></h3>
                <h5 class="mt-1">
                    <?php if ($model->stok != null || 0) : ?>
                        <span class="badge bg-gradient-success text-light"><i class="fas fa-check mx-1"></i>Stok : <?= $model->stok ?></span>
                    <?php else : ?>
                        <span class="badge bg-gradient-danger text-light"><i class="fas fa-times mx-1"></i>Stok : <?= $model->stok ?></span>
                    <?php endif ?>
                </h5>
                <hr style="border-color: black;">
                <div class="row">
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