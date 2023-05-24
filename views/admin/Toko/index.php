<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Data Toko</h4>
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
            <a href="#">Toko</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Data Toko</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel Data Toko</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Toko</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $penjual) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $penjual->name ?></td>
                                    <td class="text-center">
                                        <a class="btn bg-info-gradient text-light mx-1" data-toggle="modal" data-target="#view-penjual<?= $penjual->id ?>" href="#">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-penjual", "id" => $penjual->id], [
                                            "class" => "btn bg-danger-gradient text-light mx-1",
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

<!-- View Penjual -->
<?php foreach ($model as $view) { ?>
    <div class="modal fade" id="view-penjual<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-gradient">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Buat Jasa Kirim</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" style="border-top: hidden;">
                                <tr>
                                    <td>Nama Toko</td>
                                    <td>:</td>
                                    <td><b><?= $view->name ?></b></td>
                                </tr>
                                <tr>
                                    <td>Nama Pemilik</td>
                                    <td>:</td>
                                    <td><?= $view->user->name ?></td>
                                </tr>
                                <tr>
                                    <td>Dibuat Pada</td>
                                    <td>:</td>
                                    <td><?= date('d-m-Y', strtotime($view->created_at)) ?></td>
                                </tr>
                                <tr>
                                    <td>No Whatsapp</td>
                                    <td>:</td>
                                    <td><?= $view->no_whatsapp ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat Toko</td>
                                    <td>:</td>
                                    <td><?= $view->alamat ?></td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Toko</td>
                                    <td>:</td>
                                    <td><?= $view->deskripsi ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn bg-secondary-gradient text-light ms-3"><i class="fa fa-undo"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>