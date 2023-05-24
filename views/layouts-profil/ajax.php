<?php
if (!function_exists('RiwayatBulan')) {
    function RiwayatBulan($bulan = null)
    {
        $data = app\models\Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 1])->andWhere(['like', 'created_at', date("Y-$bulan") . '%', false])->count();
        return $data;
    }
}
$RiwayatBulan1 = RiwayatBulan("01");
$RiwayatBulan2 = RiwayatBulan("02");
$RiwayatBulan3 = RiwayatBulan("03");
$RiwayatBulan4 = RiwayatBulan("04");
$RiwayatBulan5 = RiwayatBulan("05");
$RiwayatBulan6 = RiwayatBulan("06");
$RiwayatBulan7 = RiwayatBulan("07");
$RiwayatBulan8 = RiwayatBulan("08");
$RiwayatBulan9 = RiwayatBulan("09");
$RiwayatBulan10 = RiwayatBulan("10");
$RiwayatBulan11 = RiwayatBulan("11");
$RiwayatBulan12 = RiwayatBulan("12");

$history = app\models\Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 1])->count();
$favorit = app\models\Favorit::find()->where(['user_id' => Yii::$app->user->identity->id])->count();

$pesanan = app\models\Pesanan::find()->where(['user_id' => Yii::$app->user->identity->id])->andWhere(['status' => 0])->one();
if ($pesanan != null) {
    $keranjang = app\models\PesananDetail::find()->where(['pesanan_id' => $pesanan->id])->count();
}

// Toko =============================================================================================================================================

if (Yii::$app->user->identity->role_id == 3) {
    if (!function_exists('PendapatanBulan')) {
        function PendapatanBulan($bulan = null)
        {
            $toko = app\models\Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
            $data = app\models\Products::find()
                ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
                ->where(['toko_id' => $toko->id])
                ->andWhere(['like', 'created_at', date("Y-$bulan") . '%', false])
                ->sum('pesanan_detail.total');
            return $data;
        }
    }
    $PendapatanBulan1 = PendapatanBulan("01");
    $PendapatanBulan2 = PendapatanBulan("02");
    $PendapatanBulan3 = PendapatanBulan("03");
    $PendapatanBulan4 = PendapatanBulan("04");
    $PendapatanBulan5 = PendapatanBulan("05");
    $PendapatanBulan6 = PendapatanBulan("06");
    $PendapatanBulan7 = PendapatanBulan("07");
    $PendapatanBulan8 = PendapatanBulan("08");
    $PendapatanBulan9 = PendapatanBulan("09");
    $PendapatanBulan10 = PendapatanBulan("10");
    $PendapatanBulan11 = PendapatanBulan("11");
    $PendapatanBulan12 = PendapatanBulan("12");

    $toko = app\models\Toko::find()->where(['id_user' => yii::$app->user->identity->id])->one();
    $produk = app\models\Products::find()->where(['toko_id' => $toko->id])->count();
    $terjual = app\models\Products::find()
        ->leftJoin('pesanan_detail', 'pesanan_detail.products_id=products.id')
        ->where(['toko_id' => $toko->id])
        ->andWhere(['like', 'created_at', date("Y") . '%', false])
        ->sum('pesanan_detail.jml');
}

// Sweat Alert ==================================================================================================================================
$data_flash_success = \Yii::$app->session->getFlash('berhasil');
$data_flash_error = \Yii::$app->session->getFlash('gagal');

$data = [];
if (gettype($data_flash_success) == 'string') {
    $data[] = [
        "title" => "Berhasil !",
        "text" => $data_flash_success,
        "icon" => "success",
    ];
} else if (gettype($data_flash_success) == "array") {
    foreach ($data_flash_success as $item) {
        $data[] = [
            "title" => "Berhasil !",
            "text" => $item,
            "icon" => "success",
        ];
    }
}

if (gettype($data_flash_error) == 'string') {
    $data[] = [
        "title" => "Gagal !",
        "text" => $data_flash_error,
        "icon" => "error",
    ];
} else if (gettype($data_flash_error) == "array") {
    foreach ($data_flash_error as $item) {
        $data[] = [
            "title" => "Gagal !",
            "text" => $item,
            "icon" => "error",
        ];
    }
}
?>

<!-- Line Chart Profil -->
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("AreaChartRiwayat");
    var AreaChartRiwayat = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Riwayat",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "#36b9cc",
                pointRadius: 3,
                pointBackgroundColor: "#36b9cc",
                pointBorderColor: "#36b9cc",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?= $RiwayatBulan1 ?>, <?= $RiwayatBulan2 ?>, <?= $RiwayatBulan3 ?>, <?= $RiwayatBulan4 ?>, <?= $RiwayatBulan5 ?>,
                    <?= $RiwayatBulan6 ?>, <?= $RiwayatBulan7 ?>, <?= $RiwayatBulan8 ?>, <?= $RiwayatBulan9 ?>, <?= $RiwayatBulan10 ?>,
                    <?= $RiwayatBulan11 ?>, <?= $RiwayatBulan12 ?>
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ' : ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>

<!-- Pie chart Profil -->
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChartProfil");
    var myPieChartProfil = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pesanan", "Riwayat", "Favorit"],
            datasets: [{
                data: [<?php if ($pesanan != null || 0) : ?> <?= $keranjang ?><?php else : ?>0<?php endif ?>, <?= $history ?>, <?= $favorit ?>],
                backgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b'],
                hoverBackgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
</script>

<?php if (Yii::$app->user->identity->role_id == 3) { ?>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Pendapatan",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "#1cc88a",
                    pointRadius: 3,
                    pointBackgroundColor: "#1cc88a",
                    pointBorderColor: "#1cc88a",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [<?= $PendapatanBulan1 ?>, <?= $PendapatanBulan2 ?>, <?= $PendapatanBulan3 ?>, <?= $PendapatanBulan4 ?>, <?= $PendapatanBulan5 ?>,
                        <?= $PendapatanBulan6 ?>, <?= $PendapatanBulan7 ?>, <?= $PendapatanBulan8 ?>, <?= $PendapatanBulan9 ?>, <?= $PendapatanBulan10 ?>,
                        <?= $PendapatanBulan11 ?>, <?= $PendapatanBulan12 ?>
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Rp.' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });
    </script>

    <script>
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Produk", "Penjualan(<?= date('Y') ?>)"],
                datasets: [{
                    data: [<?= $produk ?>, <?= $terjual ?>],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
<?php } ?>

<!-- Sweat alert -->
<script>
    $(function() {
        $('.modalButton').click(function() {
            console.log($(this).attr('value'));
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        });

        $("#modal").on("hide.bs.modal", function() {
            if (typeof tinyMCE !== 'undefined') {
                if (tinyMCE.activeEditor) {
                    tinyMCE.activeEditor.remove();
                }
            }
        });
    })

    window.openmodal = function(href, title = "Modal") {
        $.ajax(href, {
            success: function(response) {
                $('#modaltitle').html(title);
                $('#modalbody').html(response);
                $('#modal').modal({
                    show: 1
                });
            },
            error: function(response) {
                $('#modaltitle').html(response.statusText);
                $('#modalbody').html(response.responseText);
                $('#modal').modal({
                    show: 1
                });
            }
        })
    }

    yii.confirm = function(message, okCallback, cancelCallback) {
        Swal.fire({
            title: "<?= "Are you sure ?" ?>",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= "Yes" ?>",
            cancelButtonText: "<?= "No" ?>",
        }).then((result) => {
            if (result.isConfirmed) {
                okCallback();
            }
        });
    };

    window.alert = function(message) {
        Swal.fire({
            title: "<?= "Information !" ?>",
            text: message,
            icon: "info",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= "Ok" ?>",
        });
    };

    $(document).ready(function() {
        var list_popup = <?= json_encode($data) ?>;
        if (list_popup == null) {
            list_popup = [];
        }

        Swal.queue(list_popup);
    });
</script>

<!-- Notifikasi -->
<script>
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        Toastify({
            text: "<?= Yii::$app->session->getFlash('success') ?>",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#7fad39",
            },
            onClick: function() {}
        }).showToast();
    <?php endif ?>
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
        Toastify({
            text: "<?= Yii::$app->session->getFlash('error') ?>",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
                background: "#ED2B2A",
            },
            onClick: function() {}
        }).showToast();
    <?php endif ?>
</script>

<!-- harga produk -->
<script>
    $('#produk').on('change', function() {
        var produk = $("option:selected", this).attr("id_produk");

        $.ajax({
            type: 'post',
            url: 'produk',
            data: 'id_produk=' + produk,
            success: function(hasil) {
                $('#harga').val(hasil)
            }
        })
    })
</script>