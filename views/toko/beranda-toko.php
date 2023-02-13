<?php

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

<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <?= $this->render('sidemenu/toko', [
                        'data' => $data,
                    ]) ?>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                    <h3 class="text-isalam-1 font-weight-bold text-detail-program"></h3>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h3 class="fw-bold"><?= $produk ?></h3>
                                    <h6 class="mt-3">Total Produk</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h3 class="fw-bold"><?= $terjual ?></h3>
                                    <h6 class="mt-3">Total Penjualan</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h3 class="fw-bold">Rp. <?= number_format($pendapatan) ?></h3>
                                    <h6 class="mt-3">Total Pendapatan</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="mt-5">
                        <canvas id="myChart"></canvas>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
</div>
<?php
// $data = json_encode($chart);
// $scriptjs = <<<JS
//     const ctx = document.getElementById('myChart');

//     new Chart(ctx, {
//         type: 'bar',
//         data: {
//             labels: ['Jan', 'Feb', 'Mar', 'Aprl', 'Mei', 'Jun', 'Jul','Agus','Sept','Nov','Des'],
//             datasets: [{
//                 label: 'Total Penjualan',
//                 data: $data,
//                 borderWidth: 1
//             }]
//         },
//         options: {
//             scales: {
//                 y: {
//                     beginAtZero: true
//                 }
//             }
//         }
//     });
// JS;

// $this->registerJs($scriptjs);
