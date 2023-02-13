<div class="container">
    <div class="row">
        <div class="card-body">
            <div class="mb-5">
                <h1 class="text-success text-center"><i class="fa-regular fa-circle-check"></i></h1>
                <h2 class="text-center fw-bold mt-3">Terima Kasih Atas Pesanan Anda!!</h2>
                <h3 class="text-center mt-3">Kode Order : <a href="" class="fw-bold text-danger"><?= $pesanans->kode_unik ?></a></h3>
                <h5 class="text-center mt-2" style="font-style: italic;">Salinan atau ringkasan pesanan Anda telah dikirim ke <a href="<?= \yii\helpers\Url::to(['/profil/history', 'id' => Yii::$app->user->identity->id]) ?>" class="text-danger">Riwayat Pesanan</a></h5>
            </div>
            <h4 class="fw-bold">Ringkasan Pemesanan</h4>
            <div class="row mb-5">
                <div class="col-lg-3 mb-5">
                    <h5 class="fw-bold mt-5">Kode Order : </h5>
                    <h5 class="fw-bold mt-4">Nama :</h5>
                    <h5 class="fw-bold mt-4">Email :</h5>
                    <h5 class="fw-bold mt-4">No HP :</h5>
                    <h5 class="fw-bold mt-4">Alamat Pengiriman :</h5>
                </div>
                <div class="col-lg-3 mb-5">
                    <h5 class="fw-medium mt-5"><?= $pesanans->kode_unik ?></h5>
                    <h5 class="fw-medium mt-4"><?= $pesanans->user->name ?></h5>
                    <h5 class="fw-medium mt-4"><?= $pesanans->user->email ?></h5>
                    <h5 class="fw-medium mt-4"><?= $pesanans->user->no_hp ?>,</h5>
                    <h5 class="fw-medium mt-4"><?= $pesanans->user->alamat ?>, <?= $pesanans->user->kota ?></h5>
                </div>
                <div class="col-lg-3 mb-5">
                    <h5 class="fw-bold mt-5">Tanggal Pemesanan :</h5>
                    <h5 class="fw-bold mt-4">Status Pemesanan :</h5>
                    <h5 class="fw-bold mt-4">Jumlah Pemesanan :</h5>
                    <h5 class="fw-bold mt-4">Pengiriman :</h5>
                    <h5 class="fw-bold mt-4">Total Harga Barang :</h5>
                    <h5 class="fw-bold mt-4">Harga Pengiriman :</h5>
                    <h5 class="fw-bold mt-4">Total Harga :</h5>
                </div>
                <div class="col-lg-3 mb-5">
                    <h5 class="fw-medium mt-5"><?= date('d-m-Y', strtotime($pesanans->created_at)) ?></h5>
                    <h5 class="fw-bold mt-4 text-success"><i class="fa fa-circle-check"></i> <?= $pesanans->status_pemesanan ?></h5>
                    <h5 class="fw-medium mt-4"><?= $pesanan_details ?></h5>
                    <h5 class="fw-medium mt-4"><?= $pesanans->jasa->name ?></h5>
                    <h5 class="fw-medium mt-4">Rp. <?= number_format($pesanans->total_harga) ?></h5>
                    <h5 class="fw-medium mt-4">Rp. <?= number_format($pesanans->ongkir) ?></h5>
                    <h5 class="fw-medium mt-4">Rp. <?= number_format($pesanans->total_harga + $pesanans->ongkir) ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>