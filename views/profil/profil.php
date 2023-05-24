<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pesanan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php if ($pesanan != null) : ?>
                                <?= number_format($keranjang) ?>
                            <?php else : ?>
                                0
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Riwayat
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($history) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Favorit
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($favorit) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-heart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-7">
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Area Chart Riwayat</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="AreaChartRiwayat"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <!-- Pie Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Pie Chart</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="myPieChartProfil"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>