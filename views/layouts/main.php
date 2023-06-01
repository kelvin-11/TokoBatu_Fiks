<?php

use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= yii::$app->name ?></title>
    <?php $this->head() ?>
</head>

<body onload=getDataPenjualan()>
    <?php $this->beginBody() ?>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?= $this->render('header') ?>

    <?= $content ?>

    <?= $this->render('footer') ?>

    <?php $this->endBody() ?>
</body>
<?= $this->render('ajax') ?>

</html>
<?php $this->endPage() ?>