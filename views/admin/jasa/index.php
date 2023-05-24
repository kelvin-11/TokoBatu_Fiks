<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Jasa Kirim</h4>
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
            <a href="#">Jasa Kirim</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Data Jasa Kirim</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="justify-content: space-between;display:flex">
                    <h4 class="card-title">DataTabel Jasa Kirim</h4>
                    <?= Html::a('Buat Jasa kirim', ['#'], ['class' => 'btn bg-success-gradient text-light fw-bold', "data-toggle" => "modal", 'data-target' => "#tambah-jasa"]) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $jasa) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $jasa->name ?></td>
                                    <td><?= $jasa->slug ?></td>
                                    <td class="text-center">
                                        <a class="btn bg-primary-gradient text-light mx-1" data-toggle="modal" data-target="#edit-jasa<?= $jasa->id ?>" href="#">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-jasa", "id" => $jasa->id], [
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

<!-- Create jasa -->
<div class="modal fade" id="tambah-jasa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary-gradient">
                <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Buat Jasa Kirim</b></h5>
                <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?= Yii::$app->request->baseUrl . "/admin/buat-jasa" ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="name">Nama Jasa</label>
                                <input required type="text" class="form-control" id="" name="name" autofocus>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="slug">Slug</label>
                                <input required type="text" class="form-control" id="" name="slug">
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

<!-- Edit jasa -->
<?php foreach ($model as $edit) { ?>
    <div class="modal fade" id="edit-jasa<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary-gradient">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Edit Jasa Kirim</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="<?= Yii::$app->request->baseUrl . "/admin/update-jasa" ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="id" value="<?= $edit->id ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="name">Nama Jasa</label>
                                    <input type="text" class="form-control" value="<?= $edit->name ?>" name="name" autofocus>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="slug">Slug</label>
                                    <input type="text" class="form-control" value="<?= $edit->slug ?>" name="slug">
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