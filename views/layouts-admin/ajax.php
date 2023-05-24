<?php

if (!function_exists('transaksiBulan')) {
    function transaksiBulan($bulan = null)
    {
        $data = app\models\Pesanan::find()->where(['status' => 1])->andWhere(['like', 'created_at', date("Y-$bulan") . '%', false])->count();
        return $data;
    }
}
$transaksiBulan1 = transaksiBulan("01");
$transaksiBulan2 = transaksiBulan("02");
$transaksiBulan3 = transaksiBulan("03");
$transaksiBulan4 = transaksiBulan("04");
$transaksiBulan5 = transaksiBulan("05");
$transaksiBulan6 = transaksiBulan("06");
$transaksiBulan7 = transaksiBulan("07");
$transaksiBulan8 = transaksiBulan("08");
$transaksiBulan9 = transaksiBulan("09");
$transaksiBulan10 = transaksiBulan("10");
$transaksiBulan11 = transaksiBulan("11");
$transaksiBulan12 = transaksiBulan("12");

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
<script>
    //table =========================================================================================================================================================
    $(document).ready(function() {
        $('#basic-datatables').DataTable({});

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

        $('#add-row').DataTable({
            "pageLength": 5,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
            ]);
            $('#addRowModal').modal('hide');

        });
    });

    //radar chart =======================================================================================================================================
    // var myRadarChart = new Chart(radarChart, {
    //     type: 'radar',
    //     data: {
    //         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //         datasets: [{
    //             data: [0],
    //             borderColor: '#1572e8',
    //             backgroundColor: 'rgba(29, 122, 243, 0.25)',
    //             pointBackgroundColor: "#1572e8",
    //             pointHoverRadius: 4,
    //             pointRadius: 3,
    //             label: 'Customer'
    //         }, ]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         legend: {
    //             position: 'bottom'
    //         }
    //     }
    // });

    //multiple line chart ==================================================================================================================================================
    var myMultipleLineChart = new Chart(multipleLineChart, {
        type: 'line',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Transaksi",
                borderColor: "#1572e8",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#1572e8",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [<?= $transaksiBulan1 ?>, <?= $transaksiBulan2 ?>, <?= $transaksiBulan3 ?>, <?= $transaksiBulan4 ?>, <?= $transaksiBulan5 ?>,
                    <?= $transaksiBulan6 ?>, <?= $transaksiBulan7 ?>, <?= $transaksiBulan8 ?>, <?= $transaksiBulan9 ?>, <?= $transaksiBulan10 ?>,
                    <?= $transaksiBulan11 ?>, <?= $transaksiBulan12 ?>
                ]
            }, ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'top',
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 15,
                    right: 15,
                    top: 15,
                    bottom: 15
                }
            }
        }
    });

    //multiple bar chart =================================================================================================================================================
    var myMultipleBarChart = new Chart(multipleBarChart, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Transaksi",
                backgroundColor: '#1572e8',
                borderColor: '#1572e8',
                data: [<?= $transaksiBulan1 ?>, <?= $transaksiBulan2 ?>, <?= $transaksiBulan3 ?>, <?= $transaksiBulan4 ?>, <?= $transaksiBulan5 ?>,
                    <?= $transaksiBulan6 ?>, <?= $transaksiBulan7 ?>, <?= $transaksiBulan8 ?>, <?= $transaksiBulan9 ?>, <?= $transaksiBulan10 ?>,
                    <?= $transaksiBulan11 ?>, <?= $transaksiBulan12 ?>
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Traffic Stats'
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

    //chart pie =========================================================================================================================================
    // pieChart = document.getElementById('pieChart').getContext('2d');
    // radarChart = document.getElementById('radarChart').getContext('2d');
    // multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
    // multipleBarChart = document.getElementById('multipleBarChart').getContext('2d');

    // var myPieChart = new Chart(pieChart, {
    //     type: 'pie',
    //     data: {
    //         datasets: [{
    //             data: [0,0,0,0],
    //             backgroundColor: ["#1572e8", "#48abf7", "#31ce36", "#6861ce"],
    //             borderWidth: 0
    //         }],
    //         labels: ['Customer', 'Toko', 'Kategori', 'Jasa Kirim']
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         legend: {
    //             position: 'bottom',
    //             labels: {
    //                 fontColor: 'rgb(154, 154, 154)',
    //                 fontSize: 11,
    //                 usePointStyle: true,
    //                 padding: 20
    //             }
    //         },
    //         pieceLabel: {
    //             render: 'percentage',
    //             fontColor: 'white',
    //             fontSize: 14,
    //         },
    //         tooltips: false,
    //         layout: {
    //             padding: {
    //                 left: 20,
    //                 right: 20,
    //                 top: 20,
    //                 bottom: 20
    //             }
    //         }
    //     }
    // });


    //chart bundar =============================================================================================================================
    // Circles.create({
    //     id: 'circles-1',
    //     radius: 45,
    //     value: 0,
    //     maxValue: 100,
    //     width: 7,
    //     text: 0,
    //     colors: ['#f1f1f1', '#FF9E27'],
    //     duration: 400,
    //     wrpClass: 'circles-wrp',
    //     textClass: 'circles-text',
    //     styleWrapper: true,
    //     styleText: true
    // })

    // Circles.create({
    //     id: 'circles-2',
    //     radius: 45,
    //     value: 70,
    //     maxValue: 100,
    //     width: 7,
    //     text: 36,
    //     colors: ['#f1f1f1', '#2BB930'],
    //     duration: 400,
    //     wrpClass: 'circles-wrp',
    //     textClass: 'circles-text',
    //     styleWrapper: true,
    //     styleText: true
    // })

    // Circles.create({
    //     id: 'circles-3',
    //     radius: 45,
    //     value: 40,
    //     maxValue: 100,
    //     width: 7,
    //     text: 12,
    //     colors: ['#f1f1f1', '#F25961'],
    //     duration: 400,
    //     wrpClass: 'circles-wrp',
    //     textClass: 'circles-text',
    //     styleWrapper: true,
    //     styleText: true
    // })

    //===============================================================================================================================================
    // $(document).ready(function() {
    //     $('#detail-customer').hide()
    //     $('#detail-penjual').hide()
    //     $('#detail-produk').hide()
    //     $('#detail-jasa').hide()
    //     $('#detail-category').hide()
    //     $('#detail-pesanan').hide()

    //     $('#card1').on('click', function(e) {
    //         console.log(e.target.id);
    //         if (e.target.id == "customer") {
    //             $('#detail-customer').show()
    //             $('#detail-penjual').hide()
    //             $('#detail-produk').hide()
    //             $('#detail-jasa').hide()
    //             $('#detail-category').hide()
    //             $('#detail-pesanan').hide()
    //         } else if (e.target.id == "penjual") {
    //             $('#detail-customer').hide()
    //             $('#detail-penjual').show()
    //             $('#detail-produk').hide()
    //             $('#detail-jasa').hide()
    //             $('#detail-category').hide()
    //             $('#detail-pesanan').hide()
    //         } else if (e.target.id == "produk") {
    //             $('#detail-customer').hide()
    //             $('#detail-penjual').hide()
    //             $('#detail-produk').show()
    //             $('#detail-jasa').hide()
    //             $('#detail-category').hide()
    //             $('#detail-pesanan').hide()
    //         } else if (e.target.id == "jasa") {
    //             $('#detail-customer').hide()
    //             $('#detail-penjual').hide()
    //             $('#detail-produk').hide()
    //             $('#detail-jasa').show()
    //             $('#detail-category').hide()
    //             $('#detail-pesanan').hide()
    //         }
    //     })

    //     $('#card2').on('click', function(e) {
    //         console.log(e.target.id);
    //         if (e.target.id == "category") {
    //             $('#detail-customer').hide()
    //             $('#detail-penjual').hide()
    //             $('#detail-produk').hide()
    //             $('#detail-jasa').hide()
    //             $('#detail-category').show()
    //             $('#detail-pesanan').hide()
    //         } else if (e.target.id == "pesanan") {
    //             $('#detail-customer').hide()
    //             $('#detail-penjual').hide()
    //             $('#detail-produk').hide()
    //             $('#detail-jasa').hide()
    //             $('#detail-category').hide()
    //             $('#detail-pesanan').show()
    //         }
    //     })
    // })
</script>

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
        // swal fires the callback when the user clicks on the confirm button
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