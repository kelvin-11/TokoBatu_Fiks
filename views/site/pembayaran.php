<?php

use app\components\JSRegister;
?>
<!-- //sandbox -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ypKnWBuT86eKm1lC"></script>

<!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->

<?php JSRegister::begin(); ?>
<script>
    function setGlobal() {
        window.snap.pay('<?= $pesanan->code_transaksi_midtrans ?>', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                Swal.fire("Peringatan!", "Pembayaran Berhasil", "success").then((result) => {
                    $("#page-loader").fadeOut("slow");
                    window.location = "<?= yii\helpers\Url::to(['site/konfirmasi', 'id' => $pesanan->id]) ?>";
                });
                // alert("payment success!"); console.log(result);
            },
            // Optional
            onPending: function(result) {
                // $("#page-loader").fadeOut("slow");
                jQuery(document).ready(function() {
                    jQuery('#page-loader').fadeOut(3000);
                });
                window.location = "<?= yii\helpers\Url::to(['site/konfirmasi', 'id' => $pesanan->id]) ?>";
                // Swal.fire("Peringatan!", "Transaksi Menunggu Pembayaran", "success").then((result) => {
                // window.location = "<?= Yii::$app->request->baseUrl . "/home" ?>";
                // });
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                Swal.fire("Peringatan!", "Pembayaran Gagal", "error");
            },
            onClose: function() {
                /* You may add your own implementation here */
                Swal.fire("Peringatan!", "Anda Belum Menyelesaikan Pembayaran", "error");
            }
        });
    };
    setGlobal();
</script>
<?php JSRegister::end(); ?>