<?php

use app\models\PesananDetail;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Laporan Transaksi</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?= Url::to(['index']); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Transaksi</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Laporan Transaksi</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel Laporan Transaksi</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Kode Order</th>
                                <th>Tanggal pesanan</th>
                                <th>Status Pesanan</th>
                                <th>Total Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $p) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p->kode_unik ?></td>
                                    <td><?= date('d-M-Y', strtotime($p->created_at)) ?></td>
                                    <td><?= $p->status_pemesanan ?></td>
                                    <td>Rp. <?= number_format($p->total_harga + $p->ongkir) ?></td>
                                    <td class="text-center">
                                        <a class="btn bg-info-gradient text-light" data-toggle="modal" data-target="#view-penjualan<?= $p->id ?>" href="#" title="view">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn bg-primary-gradient text-light " data-toggle="modal" data-target="#update-penjualan<?= $p->id ?>" href="#" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-penjualan", "id" => $p->id], [
                                            "class" => "btn bg-danger-gradient text-light",
                                            "title" => "Hapus Data",
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
    </div>
</div>

<!-- Edit Transaksi -->
<?php foreach ($model as $edit) { ?>
    <div class="modal fade" id="update-penjualan<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-gradient">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Edit Laporan Transaksi</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="<?= Yii::$app->request->baseUrl . "/admin/update-penjualan" ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="id" value="<?= $edit->id ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="category">Jasa Kirim</label>
                                    <select class="form-select" name="jasa" required>
                                        <option value="<?= $edit->jasa->id ?>"><?= $edit->jasa->name ?></option>
                                        <?php foreach ($jasa as $j) { ?>
                                            <option value="<?= $j->id ?>"><?= $j->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="status">Status Pemesanan</label>
                                    <select class="form-select" name="status_pemesanan" required>
                                        <option value="<?= $edit->status_pemesanan ?>"><?= $edit->status_pemesanan ?></option>
                                        <?php foreach ($edit['status_pemesanan'] as $status) { ?>
                                            <option value="<?= $status ?>" <?php if ($status == $edit->status_pemesanan) "selected" ?>><?= $status ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="ongkir">Harga Ongkir</label>
                                    <input required type="number" class="form-control" value="<?= $edit->ongkir ?>" name="ongkir">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="harga">Harga Pesanan</label>
                                    <input required type="number" class="form-control" value="<?= $edit->total_harga ?>" name="harga">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn bg-success-gradient text-light" value="Submit">
                            <button type="button" data-dismiss="modal" class="btn bg-secondary-gradient text-light ms-3">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<!-- view Penjualan -->
<?php foreach ($model as $view) { ?>
    <div class="modal fade" id="view-penjualan<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-gradient">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Detail Laporan Transaksi</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5><b>Penerima :</b> <?= $view->user->name ?></h5>
                                    <h5 class="mt-3"></h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5><b>No.hp :</b> <?= $view->user->no_hp ?></h5>
                                </div>
                            </div>
                            <h5 class="mb-3"><b>Alamat :</b> <?= $view->user->alamat ?>,<?= $view->user->kota ?></h5>
                            <table class="table" style="border-top: hidden;">
                                <tr>
                                    <td>Tanggal Pesanan</td>
                                    <td>:</td>
                                    <td><?= date('d-M-Y', strtotime($view->created_at)) ?></td>
                                </tr>
                                <tr>
                                    <td>Produk Pesanan</td>
                                    <td>:</td>
                                    <td>
                                        <?php $pesanan_detail = PesananDetail::find()->where(['pesanan_id' => $view->id])->all();
                                        foreach ($pesanan_detail as $pd) { ?>
                                            -<?= $pd->products->name ?> : <b><?= $pd->jml ?>, <br></b>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Pesanan</td>
                                    <td>:</td>
                                    <td><?= $view->status_pemesanan ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Order</td>
                                    <td>:</td>
                                    <td><?= $view->kode_unik ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Pembayaran</td>
                                    <td>:</td>
                                    <td><?= $view->code_transaksi_midtrans ?></td>
                                </tr>
                                <tr>
                                    <td>Pengiriman</td>
                                    <td>:</td>
                                    <td><?= $view->jasa->name ?></td>
                                </tr>
                                <?php if ($view->jasa->slug != 'pos') : ?>
                                    <tr>
                                        <td>Perkiraan Sampai</td>
                                        <td>:</td>
                                        <td><?= $view->estimasi ?> Hari</td>
                                    </tr>
                                <?php else : ?>
                                    <tr>
                                        <td>Perkiraan Sampai</td>
                                        <td>:</td>
                                        <td><?= $view->estimasi ?></td>
                                    </tr>
                                <?php endif ?>
                                <tr>
                                    <td>Harga pesanan</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($view->total_harga) ?></td>
                                </tr>
                                <tr>
                                    <td>Harga Pengiriman</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($view->ongkir) ?></td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>Total Harga</td>
                                    <td>:</td>
                                    <td>Rp. <?= number_format($view->total_harga + $view->ongkir) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary-gradient text-light" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>