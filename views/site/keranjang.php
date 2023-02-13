<?php

use yii\helpers\Html;

?>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p><i class="icon fa fa-check"></i>Saved!</p>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pesanan_detail as $model) { ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="<?= \yii\helpers\Url::to(['/upload/' . $model->products->img]) ?>" alt="" style="width: 150px;height: 140px">
                                        <h5 class="fw-bold"><?= $model->products->name ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        Rp. <?= number_format($model->products->harga) ?>
                                        <input id="hargasatuan-<?= $model->id ?>" type="hidden" class="form-control" value="<?= $model->products->harga ?>">
                                    </td>
                                    <td>
                                        <div class="input-group data_produk ms-5" style="width: 140px;">
                                            <button class="input-group-text" onclick="decrease(<?= $model->id ?>)">-</button>
                                            <input id="qty-<?= $model->id ?>" type="text" class="form-control text-center" value="<?= $model->jml ?>" disabled>
                                            <button class="input-group-text" onclick="increase(<?= $model->id ?>)">+</button>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        Rp. <span class="total-<?= $model->id ?>"><?= $model->total ?></span>
                                    </td>
                                    <td class="shoping__cart__item__close text-center">
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ['remove-keranjang', "id" => $model->id], [
                                            "class" => "btn btn-danger",
                                            "title" => "Hapus",
                                            "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                            "data-method" => "POST"
                                        ]); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div> -->
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <!-- <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                            </form> -->
                        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="site-btn">Kembali Ke Home</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Total Pemesanan</h5>
                    <ul>
                        <li>Subtotal <span>Rp. <b class="pesanan"><?= $pesanan->total_harga ?></b></span></li>
                    </ul>
                    <a href="<?= \yii\helpers\Url::to(['site/checkout', 'id' => Yii::$app->user->identity->id]) ?>" class="primary-btn">LANJUTKAN KE PEMBAYARAN</a>
                </div>
            </div>
        </div>
    </div>
</section>