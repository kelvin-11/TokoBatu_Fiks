<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 text-center">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
    </div>
    <div class="card-body">
        <?= $this->render('_form-tambah-produk', [
            'model' => $model,
        ]) ?>
    </div>
</div>