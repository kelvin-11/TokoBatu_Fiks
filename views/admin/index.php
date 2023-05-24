<div class="row">
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats bg-primary-gradient card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center text-light">
                            <i class="flaticon-users"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category text-light">Customer</p>
                            <h4 class="card-title text-light"><?= $customercount ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats bg-info-gradient card-round">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center text-light">
                            <i class="flaticon-store"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category text-light">Toko</p>
                            <h4 class="card-title text-light"><?= $salercount ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats bg-success-gradient card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center text-light">
                            <i class="flaticon-network"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category text-light">Kategori</p>
                            <h4 class="card-title text-light"><?= $categorycount ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="card card-stats bg-secondary-gradient card-round">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center text-light">
                            <i class="flaticon-delivery-truck"></i>
                        </div>
                    </div>
                    <div class="col-7 col-stats">
                        <div class="numbers">
                            <p class="card-category text-light">Jasa Kirim</p>
                            <h4 class="card-title text-light"><?= $jasacount ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- radar chart -->
    <!-- <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Radar Chart</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="radarChart"></canvas>
                </div>
            </div>
        </div>
    </div> -->
    <!-- multiple line chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Line Chart Data Transaksi</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="multipleLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- multiple bar chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Bar Chart Data Transaksi</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="multipleBarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- pie chart -->
    <!-- <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Pie Chart</div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                </div>
            </div>
        </div>
    </div> -->
</div>

<!-- <div class="col-md-12">
    <div class="card full-height">
        <div class="card-body">
            <div class="card-title">Overall statistics</div>
            <div class="card-category">Daily information about statistics in system</div>
            <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                <div class="px-2 pb-2 pb-md-0 text-center">
                    <div id="circles-1"></div>
                    <h6 class="fw-bold mt-3 mb-0">New Users</h6>
                </div>
                <div class="px-2 pb-2 pb-md-0 text-center">
                    <div id="circles-2"></div>
                    <h6 class="fw-bold mt-3 mb-0">Sales</h6>
                </div>
                <div class="px-2 pb-2 pb-md-0 text-center">
                    <div id="circles-3"></div>
                    <h6 class="fw-bold mt-3 mb-0">Subscribers</h6>
                </div>
            </div>
        </div>
    </div>
</div> -->