<div class="page-header">
    <h4 class="page-title">Edit Kategori</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="<?= yii\helpers\Url::to(['index']); ?>">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Kategori</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Edit Kategori</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Kategori</div>
            </div>
            <div class="card-body">
                <?= $this->render('form_category', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>