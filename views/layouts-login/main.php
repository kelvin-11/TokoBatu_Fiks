<?php

use app\assets\LoginAsset;

LoginAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= yii::$app->name ?></title>
    <?php $this->head() ?>
    <!-- <style>
        body {
            background: linear-gradient(9deg, rgba(0, 112, 255, 1) 0%, rgba(124, 207, 0, 1.0) 100%);
            /* background:  rgba(124, 207, 0, 1.0) 100%; */
        }
    </style> -->
</head>

<body>
    <?php $this->beginBody() ?>
    <!-- <div class="container"> -->
    <?= $content ?>
    <!-- </div> -->
    <?php $this->endBody() ?>
</body>

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

</html>
<?php $this->endPage() ?>