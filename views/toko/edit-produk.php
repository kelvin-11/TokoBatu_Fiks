<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <?= $this->render('sidemenu/toko', [
                        'data' => $data,
                    ]) ?>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section pb-20">
                    <div class="card bg-warning" style="border-radius: 4%;">
                        <h4 class="text-isalam-1 font-weight-bold text-detail-program text-center mt-3">Edit Produk</h4>
                        <div class="card-body">
                            <?= $this->render('_form-tambah-produk', [
                                'model' => $model,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>