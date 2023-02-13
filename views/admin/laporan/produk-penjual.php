<?php

use yii\helpers\Url;

?>
<div class="page-header">
    <h4 class="page-title">Laporan</h4>
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
            <a href="#">Laporan</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Produk Penjual</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Laporan Produk Penjual</div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-info text-center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Toko</th>
                                <th>Produk Terjual </th>
                                <th>Jumlah Pendapatan</th>
                            </tr>
                        </thead>
                        <?php $no = 1;
                        foreach ($model as $p) {
                            $terjual = \app\models\Products::find()
                                ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
                                ->where(['toko_id' => $p->id])
                                ->sum('pesanan_detail.jml');
                            if ($terjual) {
                                $penjualan = $terjual;
                            } else {
                                $penjualan = 0;
                            }

                            $pendapatan = \app\models\Products::find()
                                ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
                                ->where(['toko_id' => $p->id])
                                ->sum('pesanan_detail.total');
                            if ($pendapatan) {
                                $penghasilan = $pendapatan;
                            } else {
                                $penghasilan = 0;
                            }
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $p->name ?></td>
                                    <td><?= $penjualan ?></td>
                                    <td>Rp. <?= number_format($penghasilan) ?></td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
                <div class="pagination d-flex justify-content-center mt-2">
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