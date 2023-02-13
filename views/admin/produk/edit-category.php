<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h2 class="fw-bold text-primary text-center mb-3">Edit Category</h2>
                <hr style="border-color: black;">
                <?= $this->render('form_category', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>