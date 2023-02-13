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
    <h4 class="page-title">Produk</h4>
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
            <a href="#">Produk</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Produk Admin</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card-title">Table Produk</div>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::a('Buat Produk', ['buat-produk', 'id' => Yii::$app->user->identity->id], ['class' => 'btn btn-success ms-3 text-light']) ?>
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
                                <th>Category</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($model as $produk) { ?>
                            <tbody>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $produk->name ?></td>
                                    <td><?= $produk->category->name ?></td>
                                    <td>Rp. <?= number_format($produk->harga) ?></td>
                                    <td>
                                        <a class="btn btn-warning" data-toggle="modal" data-target="#view-produk<?= $produk->id ?>" href="#">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-produk", "id" => $produk->id], [
                                            "class" => "btn btn-danger",
                                            "title" => "Hapus Data",
                                            "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                            "data-method" => "POST"
                                        ]); ?>
                                        <a class="btn btn-primary " href="<?= yii\helpers\Url::to(["update-produk", "id"=>$produk->id]) ?>">
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

<!-- View produk -->
<?php foreach ($model as $view) { ?>
    <div class="modal fade" id="view-produk<?= $view->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="">view Produk</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <img class="product__details__pic__item " src="<?= Url::to(['/upload/' . $view->img]) ?>" alt="" style="width: 320px;height: 350px;border-radius: 5%">
                        </div>
                        <div class="col-lg-7">
                            <h2><strong><?= $view->name ?></strong></h2>
                            <h5 class="mt-1">
                                <?php if ($view->stok != null) : ?>
                                    <span class="badge bg-success text-light"><i class="fas fa-check mx-1"></i>Stok : <?= $view->stok ?></span>
                                <?php else : ?>
                                    <span class="badge bg-danger text-light"><i class="fas fa-times mx-2"></i>Stok : <?= $view->stok ?></span>
                                <?php endif ?>
                            </h5>
                            <hr style="border-color: black;">
                            <div class="row">
                                <div class="col">
                                    <table class="table" style="border-top: hidden;">
                                        <tr>
                                            <td>Harga</td>
                                            <td>:</td>
                                            <td>Rp. <?= number_format($view->harga) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>:</td>
                                            <td><?= $view->category->name ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berat Produk</td>
                                            <td>:</td>
                                            <td><?= $view->berat ?> Gram</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi Produk</td>
                                            <td>:</td>
                                            <td><?= $view->deskripsi_produk ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary ms-3"><i class="fa fa-undo"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>