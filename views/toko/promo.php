<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Promo</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div style="justify-content: space-between;display:flex;">
            <h6 class="m-0 font-weight-bold text-primary" style="padding-top: 10px;">DataTabel Promo Produk </h6>
            <?= yii\helpers\Html::a('Buat Promo', ['#'], ['class' => 'btn bg-gradient-success text-light fw-bold', "data-toggle" => "modal", 'data-target' => "#tambah-promo"]) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Harga Promo</th>
                        <th>Tanggal Mulai Promo</th>
                        <th>Tanggal Berakhir Promo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($model as $row) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row->products->name ?></td>
                            <td>Rp. <?= number_format($row->nilai) ?></td>
                            <td><?= date('d-M-Y', strtotime($row->date_start)) ?></td>
                            <td><?= date('d-M-Y', strtotime($row->date_end)) ?></td>
                            <td class="text-center" style="width: 200px;">
                                <a data-toggle="modal" title="" href="#modalview<?= $row->id ?>" class="btn bg-gradient-info text-light" data-original-title="Show Details">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a data-toggle="modal" title="" href="#modalEdit<?= $row->id ?>" class="btn bg-gradient-primary text-light" data-original-title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?= yii\helpers\Html::a("<i class='fa fa-trash-alt'></i>", ["delete-promo", "id" => $row->id], [
                                    "class" => "btn bg-gradient-danger text-light mx-1",
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

<!-- Create Promo -->
<div class="modal fade" id="tambah-promo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-gradient-success">
                <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Buat Promo</b></h5>
                <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form action="<?= Yii::$app->request->baseUrl . "/toko/buat-promo" ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                <input type="hidden" name="toko" value="<?= $toko->id ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="name">Produk</label>
                                <select required class="form-select" name="produk" id="produk">
                                    <option value="">Pilih Produk</option>
                                    <?php foreach ($produk as $key => $value) { ?>
                                        <option id_produk="<?= $value->id ?>" value="<?= $value->id ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="">Harga Produk</label>
                                <input readonly type="text" class="form-control" id="harga" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="promo">Harga Promo</label>
                                <input required type="number" class="form-control" id="" name="promo" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="date_start">Tanggal Mulai Promo</label>
                                <input required type="date" class="form-control" id="" name="date_start">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="fw-bold ms-1" for="date_end">Tanggal Berakhir Promo</label>
                                <input required type="date" class="form-control" id="" name="date_end">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn bg-gradient-success text-light" value="Submit">
                        <button type="button" data-dismiss="modal" class="btn bg-gradient-secondary text-light ms-3">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detail Promo -->
<?php foreach ($model as $detail) { ?>
    <div class="row">
        <div class="modal fade" id="modalview<?= $detail->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-info">
                        <h5 class="modal-title text-light" id="exampleModalLongTitle"><b> Detail Promo</b></h5>
                        <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table " style="border-top: hidden;">
                                    <tr>
                                        <td>Produk</td>
                                        <td>:</td>
                                        <td><?= $detail->products->name ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Produk</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($detail->products->harga) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Promo</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($detail->nilai) ?></td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total Harga</td>
                                        <td>:</td>
                                        <td>Rp. <?= number_format($detail->products->harga - $detail->nilai) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Promo</td>
                                        <td>:</td>
                                        <td><?= date('d-M-Y', strtotime($detail->date_start)) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir Promo</td>
                                        <td>:</td>
                                        <td><?= date('d-M-Y', strtotime($detail->date_end)) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Buat</td>
                                        <td>:</td>
                                        <td><?= date('d-M-Y', strtotime($detail->created_at)) ?></td>
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

<!-- Edit promo -->
<?php foreach ($model as $edit) { ?>
    <div class="modal fade" id="modalEdit<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary ">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"><b>Edit Promo</b></h5>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="<?= Yii::$app->request->baseUrl . "/toko/update-promo" ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="id" value="<?= $edit->id ?>">
                    <input type="hidden" name="produk" value="<?= $edit->products->id ?>">
                    <input type="hidden" name="toko" value="<?= $toko->id ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="name">Produk</label>
                                    <input readonly type="text" class="form-control" value="<?= $edit->products->name ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="">Harga Produk</label>
                                    <input readonly type="text" class="form-control" value="<?= $edit->products->harga ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="promo">Harga Promo</label>
                                    <input type="number" class="form-control" id="" name="promo" value="<?= $edit->nilai ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="date_start">Tanggal Mulai Promo</label>
                                    <input type="date" class="form-control" id="" name="date_start" value="<?= date('Y-m-d', strtotime($edit->date_start)) ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold ms-1" for="date_end">Tanggal Berakhir Promo</label>
                                    <input type="date" class="form-control" id="" name="date_end" value="<?= date('Y-m-d', strtotime($edit->date_end)) ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn bg-gradient-success text-light" value="Submit">
                            <button type="button" data-dismiss="modal" class="btn bg-gradient-secondary text-light ms-3">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>