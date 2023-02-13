<div class="row" id="card1">
    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total Customer</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="customer" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $customercount ?></h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total Penjual</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="penjual" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $salercount ?></h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total Produk</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="produk" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $produkcount ?></h4>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total JasaKirim</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="jasa" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $jasacount ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row" id="card2">
    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total Kategori</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="category" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $categorycount ?></h4>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon1" class="fa-solid fa-street-view"></i></H1>
            </div>
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon2" class="fa-solid fa-ghost"></i></i></H1>
            </div>
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon3" class="fa-brands fa-docker"></i></H1>
            </div>
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon4" class="fa-solid fa-earth-americas"></i></H1>
            </div>
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon5" class="fa-solid fa-snowflake"></i></H1>
            </div>
            <div class="col-lg-2">
                <H1 class="text-center mt-4 "><i data-toggle="modal" data-target="#icon6" class="fa-solid fa-bug"></i></H1>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card bg-primary-gradient">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="text-light">Total Pesanan</p>
                    </div>
                    <div class="col-lg-4">
                        <p type="submit" id="pesanan" class="text-warning">detail</p>
                    </div>
                </div>
                <h4 class="fw-bold ms-2 text-light"><?= $pesanancount ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card bg-info-gradient" id="detail-customer">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No_HP</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($customer as $c) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $c->name ?></td>
                                    <td><?= $c->email ?></td>
                                    <td><?= $c->alamat ?></td>
                                    <td><?= $c->no_hp ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagecustomer,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="card bg-info-gradient" id="detail-penjual">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Nama Penjual</th>
                                <th>Nama Toko</th>
                                <th>Deskripsi Toko</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($saler as $s) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s->user->name ?></td>
                                    <td><?= $s->name ?></td>
                                    <td><?= $s->deskripsi ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagesaler,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="card bg-info-gradient" id="detail-produk">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Nama Produk</th>
                                <th>Category</th>
                                <th>Toko</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Berat</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($produk as $p) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p->name ?></td>
                                    <td><?= $p->category->name ?></td>
                                    <td><?= $p->toko->name ?></td>
                                    <td>Rp. <?= number_format($p->harga) ?></td>
                                    <td><?= $p->stok ?></td>
                                    <td><?= $p->berat ?> Gram</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pageproduk,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="card bg-info-gradient" id="detail-jasa">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Nama Jasa Kirim</th>
                                <th>Slug</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($jasa as $j) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $j->name ?></td>
                                    <td><?= $j->slug ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagejasa,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="card bg-info-gradient" id="detail-category">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Nama Category</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($category as $c) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $c->name ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagecategory,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>

        <div class="card bg-info-gradient" id="detail-pesanan">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center" style="border-top: hidden;">
                        <thead class="text-warning fw-bold">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Pesanan</th>
                                <th>Kode Order</th>
                                <th>Jasa Kirim</th>
                                <th>Paket</th>
                                <th>Estimasi</th>
                                <th>Status Pemesanan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php $no = 1;
                            foreach ($pesanan as $p) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('y-m-d', strtotime($p->created_at)) ?></td>
                                    <td><a href="<?= yii\helpers\Url::to(['penjualan']) ?>" class="text-light text-decoration-none"><?= $p->kode_unik ?></a></td>
                                    <td><?= $p->jasa->name ?></td>
                                    <td><?= $p->paket ?></td>
                                    <?php if ($p->jasa->slug != 'pos') : ?>
                                        <td><?= $p->estimasi ?> Hari</td>
                                    <?php else : ?>
                                        <td><?= $p->estimasi ?></td>
                                    <?php endif ?>
                                    <td><?= $p->status_pemesanan ?></td>
                                    <td>Rp. <?= number_format($p->total_harga + $p->ongkir) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pagepesanan,
                        'linkContainerOptions' => ['class' => 'page-item'],
                        'linkOptions' => ['class' => 'page-link'],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-success"><i class="fa-solid fa-street-view"></i></H1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-danger"><i class="fa-solid fa-ghost"></i></i></H1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-primary"><i class="fa-brands fa-docker"></i></H1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-success"><i class="fa-solid fa-earth-americas"></i></H1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-primary"><i class="fa-solid fa-snowflake"></i></H1>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="icon6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <H1 class="text-center py-5 text-danger"><i class="fa-solid fa-bug"></i></H1>
            </div>
        </div>
    </div>
</div>