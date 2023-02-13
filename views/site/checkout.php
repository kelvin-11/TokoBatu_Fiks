<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="checkout__form mb-5">
        <h4>IsI Data Pengiriman</h4>
        <form action="<?= Yii::$app->request->baseUrl . "/site/create-checkout" ?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
            <!-- Pr mengisikan jumlah berat keseluruhan -->
            <input required type="hidden" name="berat" id="berat" value="1000">
            <input required type="hidden" name="distrik" value="<?= $pesanan->user->kota ?>">
            <input required type="hidden" name="provinsi" value="<?= $pesanan->user->provinsi ?>">
            <input required type="hidden" name="type" value="<?= $pesanan->user->type ?>">
            <input required type="hidden" name="codepos" value="<?= $pesanan->user->codepos ?>">

            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="checkout__input">
                        <p>Alamat :</p>
                        <input required class="fw-bold" type="text" name="alamat" placeholder="Your Address" autofocus value="<?= $pesanan->user->alamat ?>">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Provinsi Asal</label>
                            <div class="card" id="provinsi">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Kota/Kabupaten Asal</label>
                            <div class="card" id="distrik">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <label for="">Metode Pengiriman</label>
                            <hr style="border-color: black" id="hr">
                            <div class="card" id="jasacard">
                                <select required style="display:block;" name="select" id="jasa">
                                    <option value="">--Pilih Metode Pengiriman--</option>
                                    <?php foreach ($pengiriman as $p) { ?>
                                        <option value="<?= $p->id ?>" slug="<?= $p->slug ?>"><?= $p->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="">Paket Pengiriman</label>
                            <div class="card" id="paket">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>No Whatsapp :</p>
                                <input required class="fw-bold" type="number" name="no_hp" placeholder="08--" value="<?= $pesanan->user->no_hp ?>">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Email :</p>
                                <input required class="fw-bold" type="email" name="email" value="<?= yii::$app->user->identity->email ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4>Pesanan Kamu</h4>
                        <div class="checkout__order__products">Produk <span>Total</span></div>
                        <ul>
                            <?php foreach ($pesanan_detail as $detail) { ?>
                                <li><?= $detail->products->name ?> <span>Rp. <?= number_format($detail->total) ?></span></li>
                            <?php } ?>
                        </ul>
                        <div class="checkout__order__total" id="kirim">Ongkir <span>Rp. <b id="biaya_ongkir"><?= $pesanan->ongkir ?></b></span></div>
                        <input type="hidden" id="ttl" value="<?= $pesanan->total_harga ?>">
                        <div class="checkout__order__total">Total Harga<span>Rp. <b id="total_biaya"><?= $pesanan->total_harga + $pesanan->ongkir ?></b></span></div>
                        <button type="submit" class="site-btn">Pesan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>