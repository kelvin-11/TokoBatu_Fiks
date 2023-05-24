<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Data Kategori</h4>
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
            <a href="#">Kategori</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Data Kategori</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="justify-content: space-between;display:flex">
                    <h4 class="card-title">DataTabel Kategori</h4>
                    <?= Html::a('Buat Category', ['buat-category'], ['class' => 'btn bg-success-gradient text-light fw-bold']) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $category) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $category->name ?></td>
                                    <td>
                                        <img src="<?= Url::to(['/upload/' . $category->img]) ?>" alt="" style="width: 80px;height: 80px">
                                    </td>
                                    <td class="text-center">
                                        <a class="btn bg-primary-gradient text-light" href="<?= yii\helpers\Url::to(['update-category', 'id' => $category->id]) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?= Html::a("<i class='fa fa-trash-alt'></i>", ["delete-category", "id" => $category->id], [
                                            "class" => "btn bg-danger-gradient mx-2 text-light",
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