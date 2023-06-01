<style>
    .card-img-top {
        width: auto;
        height: 270px;
        position: relative;
        overflow: hidden;
        background-position: center center
    }

    .tx-title {
        text-align: center;
        font-weight: bold;
        font-size: 22px;
        margin-bottom: 10px;
    }

    .tx-content {
        text-align: center;
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .btn {
        display: flex;
        justify-content: center;
        height: 38px;
        padding: 10px;
    }
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List Favorit</h1>
</div>

<div class="row">
    <?php foreach ($favorit as $item) {
        $promo = app\models\Promo::find()->where(['products_id' => $item->products->id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
    ?>
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4">
            <div class="card shadow mb-4">
                <img src="<?= yii\helpers\Url::to(['/upload/' . $item->products->img]) ?>" class="card-img-top" alt="">
                <div class="card-body">
                    <div class="row">
                        <p class="tx-title"><?= $item->products->name ?></p>
                        <div class="col-lg-6">
                            <p class="tx-content"><?= $item->products->category->name ?></p>
                        </div>
                        <div class="col-lg-6">
                            <?php if ($promo) : ?>
                                <p class="tx-content">Rp. <?= number_format($item->products->harga - $promo->nilai) ?></p>
                            <?php else : ?>
                                <p class="tx-content">Rp. <?= number_format($item->products->harga) ?></p>
                            <?php endif ?>
                        </div>

                        <form action="<?= Yii::$app->request->baseUrl . "/site/create-keranjang" ?>" method="post" id="keranjang<?= $item->products->id ?>">
                            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken ?>">
                            <input type="hidden" name="produk_id" value="<?= $item->products->id ?>">
                        </form>

                        <div class="col-lg-4">
                            <?= yii\helpers\Html::a("<i class='fa fa-trash'></i>", ['delete-favorit', "id" => $item->id], [
                                "class" => "btn bg-gradient-danger text-light",
                                "title" => "Hapus",
                                "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                "data-method" => "POST"
                            ]); ?>
                        </div>
                        <div class="col-lg-4">
                            <a class="btn bg-gradient-info text-light" href="<?= \yii\helpers\Url::to(['/site/detail', 'id' => $item->products->id]) ?>"><i class="fa fa-eye"></i></a>
                        </div>
                        <div class="col-lg-4">
                            <?php if ($item->products->stok != null) : ?>
                                <a class="btn bg-gradient-success text-light" onclick="document.querySelector('#keranjang<?= $item->products->id ?>').submit()"><i class="fa fa-shopping-cart"></i></a>
                            <?php else : ?>
                                <a class="btn bg-gradient-success text-light" href="#"><i class="fa fa-shopping-cart"></i></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>