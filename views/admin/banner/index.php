<div class="page-header">
    <h4 class="page-title">Data Banner</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?= yii\helpers\Url::to(['index']); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Banner</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Data Banner</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div style="justify-content: space-between;display:flex">
                    <h4 class="card-title">DataTabel Banner</h4>
                    <?= yii\helpers\Html::a('Buat Banner', ['buat-banner'], ['class' => 'btn bg-success-gradient text-light fw-bold']) ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Gambar</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($model as $banner) { ?>
                                <tr class="text-center">
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <img src="<?= yii\helpers\Url::to(['/upload/' . $banner->image]) ?>" alt="" style="width: 80px;height: 80px">
                                    </td>
                                    <td><?= date('d M Y', strtotime($banner->date_start)) ?></td>
                                    <td><?= date('d M Y', strtotime($banner->date_end)) ?></td>
                                    <td class="text-center">
                                        <a class="btn bg-primary-gradient text-light" href="<?= yii\helpers\Url::to(['update-banner', 'id' => $banner->id]) ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?= yii\helpers\Html::a("<i class='fa fa-trash-alt'></i>", ["delete-banner", "id" => $banner->id], [
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