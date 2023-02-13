<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
<div class="page-header">
    <h4 class="page-title">Jasa</h4>
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
            <a href="#">Jasa</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Index</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card-title">Table Jasa</div>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::a('Buat Jasa kirim', ['#'], ['class' => 'btn btn-success text-light', "data-toggle" => "modal", 'data-target' => "#tambah-jasa"]) ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-info text-center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($model as $jasa) { ?>
                            <tbody>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $jasa->name ?></td>
                                    <td><?= $jasa->slug ?></td>
                                    <td>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-jasa", "id" => $jasa->id], [
                                            "class" => "btn btn-danger mx-1",
                                            "title" => "Hapus Data",
                                            "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                            "data-method" => "POST"
                                        ]); ?>
                                        <a class="btn btn-primary mx-1" data-toggle="modal" data-target="#edit-jasa<?= $jasa->id ?>" href="#">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagination,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create jasa -->
<div class="modal fade" id="tambah-jasa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="">Tambah Jasa Kirim</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= Yii::$app->request->baseUrl . "/admin/buat-jasa" ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="name">Nama Jasa</label>
                                <input required type="text" class="form-control" id="" name="name" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input required type="text" class="form-control" id="" name="slug">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <button type="button" data-dismiss="modal" class="btn btn-danger ms-3">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit jasa -->
<?php foreach ($model as $edit) { ?>
    <div class="modal fade" id="edit-jasa<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="">Update Jasa Kirim</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= Yii::$app->request->baseUrl . "/admin/update-jasa" ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="id" value="<?= $edit->id ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="name">Nama Jasa</label>
                                    <input type="text" class="form-control" value="<?= $edit->name ?>" name="name" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" value="<?= $edit->slug ?>" name="slug">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <button type="button" data-dismiss="modal" class="btn btn-danger ms-3">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>