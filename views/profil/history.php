<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Pembelian</h1>
</div>

<div class="card shadow mb-5">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTabel Riwayat Pembelian </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
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
                            <td><?= date('d-M-Y', strtotime($pesanan->created_at)) ?></td>
                            <td><?= $pesanan->status_pemesanan ?></td>
                            <td>Rp. <?= number_format($pesanan->total_harga + $pesanan->ongkir) ?></td>
                            <td>
                                <a data-toggle="modal" title="" href="#modalview<?= $pesanan->id ?>" class="btn bg-gradient-info text-light" data-original-title="Show Details">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Detail History Pesanan -->
<?php foreach ($pesanans as $detail) { ?>
    <div class="row">
        <div class="modal fade" id="modalview<?= $detail->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title text-light" id="exampleModalLongTitle"><b> Detail Data Pesanan</b></h5>
                        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5><b>Penerima :</b> <?= $detail->user->name ?></h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5><b>No.Hp :</b> <?= $detail->user->no_hp ?></h5>
                                    </div>
                                </div>
                                <h5 class="mb-3"><b>Alamat :</b> <?= $detail->user->alamat ?>, <?= $detail->user->kota ?></h5>
                                <table class="table " style="border-top: hidden;">
                                    <tr>
                                        <td>Tanggal Pesanan</td>
                                        <td>:</td>
                                        <td><?= date('d-m-Y', strtotime($detail->created_at)) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Produk Pesanan</td>
                                        <td>:</td>
                                        <td>
                                            <?php $pesanan_detail = app\models\PesananDetail::find()->where(['pesanan_id' => $detail->id])->all();
                                            foreach ($pesanan_detail as $pd) { ?>
                                                -<?= $pd->products->name ?> : <b><?= $pd->jml ?>,<br></b>
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
                        <button type="button" class="btn bg-gradient-secondary text-light" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>