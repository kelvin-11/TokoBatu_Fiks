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
    <h4 class="page-title">Category</h4>
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
            <a href="#">Category</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card-title">Tabel Category</div>
                    </div>
                    <div class="col-lg-2">
                        <?= Html::a('Buat Category', ['buat-category'], ['class' => 'btn btn-success text-light']) ?>
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
                                <th>Img</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($model as $category) { ?>
                            <tbody>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $category->name ?></td>
                                    <td>
                                        <img src="<?= Url::to(['/upload/' . $category->img]) ?>" alt="" style="width: 80px;height: 80px">
                                    </td>
                                    <td>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-category", "id" => $category->id], [
                                            "class" => "btn btn-danger mx-2",
                                            "title" => "Hapus Data",
                                            "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                            "data-method" => "POST"
                                        ]); ?>
                                        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['update-category', 'id' => $category->id]) ?>">
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