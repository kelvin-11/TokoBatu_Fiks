<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                            <?php foreach ($pesanan_detail as $model) {
                                $promo = app\models\Promo::find()->where(['products_id' => $model->products_id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
                            ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="<?= \yii\helpers\Url::to(['/upload/' . $model->products->img]) ?>" alt="" style="width: 150px;height: 140px">
                                        <h5 class="fw-bold"><?= $model->products->name ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php if ($promo) : ?>
                                            Rp. <?= number_format($model->products->harga - $promo->nilai) ?>
                                            <del class="text-muted">Rp. <?= number_format($model->products->harga) ?></del>
                                            <input id="hargasatuan-<?= $model->id ?>" type="hidden" class="form-control" value="<?= $model->products->harga - $promo->nilai ?>">
                                        <?php else : ?>
                                            Rp. <?= number_format($model->products->harga) ?>
                                            <input id="hargasatuan-<?= $model->id ?>" type="hidden" class="form-control" value="<?= $model->products->harga ?>">
                                        <?php endif ?>
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
                                        <?= yii\helpers\Html::a("<i class='fa fa-trash-alt'></i>", ['remove-keranjang', "id" => $model->id], [
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
                    <h5><b>Total Pemesanan</b></h5>
                    <ul>
                        <li><b>Subtotal</b> <span><b>Rp.</b> <b class="pesanan"><?= $pesanan->total_harga ?></b></span></li>
                    </ul>
                    <a href="<?= \yii\helpers\Url::to(['site/checkout', 'id' => Yii::$app->user->identity->id]) ?>" class="primary-btn">LANJUTKAN KE PEMBAYARAN</a>
                </div>
            </div>
        </div>
    </div>
</section>