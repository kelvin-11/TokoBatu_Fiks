<?php

use app\models\PesananDetail;

?>
<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <?= $this->render('sidemenu/profil', [
                        'model' => $model,
                        'identy' => $identy
                    ]);
                    ?>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                    <h3 class="text-isalam-1 font-weight-bold text-detail-program"></h3>
                    <div class="card bg-warning">
                        <div class="card-body">
                            <?php if ($pesanans != null) : ?>
                                <table class="table table-dark text-center">
                                    <thead class="text-warning">
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode Pemesanan</th>
                                            <th>Tanggal pememesanan</th>
                                            <th>Status Pesanan</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($pesanans as $pesanan) { ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $pesanan->kode_unik ?></td>
                                                <td><?= date('d-m-Y', strtotime($pesanan->created_at)) ?></td>
                                                <td><?= $pesanan->status_pemesanan ?></td>
                                                <td>Rp. <?= number_format($pesanan->total_harga + $pesanan->ongkir) ?></td>
                                                <td>
                                                    <a data-toggle="modal" title="" href="#modalview<?= $pesanan->id ?>" class="btn btn-link btn-warning text-dark" data-original-title="Show Details">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="product__pagination d-flex justify-content-center">
                                    <?php echo \yii\widgets\LinkPager::widget([
                                        'pagination' => $pagination,
                                    ]); ?>
                                </div>
                            <?php else : ?>
                                <h2 class="text-danger fw-bold text-center">Anda Tidak Memiliki History Pesanan!</h2>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Detail History Pesanan -->
<?php foreach ($pesanans as $detail) { ?>
    <div class="modal fade" id="modalview<?= $detail->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title text-light" id="exampleModalLongTitle"><b> Detail Data Pesanan</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5><b>Penerima :</b> <?= $detail->user->name ?></h5>
                                    <h5 class="mt-3"></h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5><b>No.Hp :</b> <?= $detail->user->no_hp ?></h5>
                                </div>
                            </div>
                            <h5 class="mb-3"><b>Alamat :</b> <?= $detail->user->alamat ?>, <?= $detail->user->kota ?></h5>
                            <table class="table" style="border-top: hidden;">
                                <tr>
                                    <td>Tanggal Pesanan</td>
                                    <td>:</td>
                                    <td><?= date('d-m-Y', strtotime($detail->created_at)) ?></td>
                                </tr>
                                <tr>
                                    <td>Produk Pesanan</td>
                                    <td>:</td>
                                    <td>
                                        <?php $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $detail->id])->all();
                                        foreach ($pesanan_detail as $pd) { ?>
                                            <?= $pd->products->name ?> : <b><?= $pd->jml ?>,</b>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Pesanan</td>
                                    <td>:</td>
                                    <td><?= $detail->status_pemesanan ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Order</td>
                                    <td>:</td>
                                    <td><?= $detail->kode_unik ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Pembayaran</td>
                                    <td>:</td>
                                    <td><?= $detail->code_transaksi_midtrans ?></td>
                                </tr>
                                <tr>
                                    <td>Pengiriman</td>
                                    <td>:</td>
                                    <td><?= $detail->jasa->name ?></td>
                                </tr>
                                <?php if ($detail->jasa->slug != 'pos') : ?>
                                    <tr>
                                        <td>Perkiraan Sampai</td>
                                        <td>:</td>
                                        <td><?= $detail->estimasi ?> Hari</td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td>Perkiraan Sampai</td>
                                        <td>:</td>
                                        <td><?= $detail->estimasi ?></td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td>Harga pesanan</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($detail->total_harga) ?></td>
                                </tr>
                                <tr>
                                    <td>Harga Pengiriman</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($detail->ongkir) ?></td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>Total Harga</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($detail->total_harga + $detail->ongkir) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>