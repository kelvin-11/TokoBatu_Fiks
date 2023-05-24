<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Data Customer</h4>
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
            <a href="#">Customer</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Data Customer</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel Data Customer</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $customer) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $customer->name ?></td>
                                    <td class="text-center">
                                        <a class="btn bg-info-gradient text-light mx-1" data-toggle="modal" data-target="#view-customer<?= $customer->id ?>" href="#">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-customer", "id" => $customer->id], [
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

<!-- View Customer -->
<?php foreach ($model as $view) { ?>
    <div class="modal fade" id="view-customer<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary-gradient">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Detail Data Customer</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table" style="border-top: hidden;">
                                <tr>
                                    <td>Nama Customer</td>
                                    <td>:</td>
                                    <td><?= $view->name ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?= $view->email ?></td>
                                </tr>
                                <tr>
                                    <td>No_Hp</td>
                                    <td>:</td>
                                    <td><?= $view->no_hp ?></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>:</td>
                                    <td><?= $view->provinsi ?></td>
                                </tr>
                                <tr>
                                    <td>Kota/Kabupaten</td>
                                    <td>:</td>
                                    <td><?= $view->kota ?></td>
                                </tr>
                                <tr>
                                    <td>Kodepos</td>
                                    <td>:</td>
                                    <td><?= $view->codepos ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= $view->alamat ?></td>
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