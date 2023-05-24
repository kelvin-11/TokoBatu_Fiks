<?php
$identy = Yii::$app->user->identity;
?>
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: green;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= \yii\helpers\Url::to(['/', 'id' => yii::$app->user->identity->id]) ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Toko Batu <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/profil/profil', 'id' => yii::$app->user->identity->id]) ?>">
            <i class="fas fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Componen
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/profil/history', 'id' => yii::$app->user->identity->id]) ?>">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Riwayat Pembelian</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?= \yii\helpers\Url::to(['/profil/favorit', 'id' => yii::$app->user->identity->id]) ?>">
            <i class="fas fa-fw fa-heart"></i>
            <span>Favorit</span></a>
    </li>

    <?php if ($identy->role_id != 3) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/toko/register-toko', 'id' => yii::$app->user->identity->id]) ?>">
                <i class="fas fa-fw fa-store"></i>
                <span>Membuat Toko</span></a>
        </li>
    <?php else : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/toko/beranda-toko', 'id' => yii::$app->user->identity->id]) ?>">
                <i class="fas fa-fw fa-store"></i>
                <span>Toko</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/toko/toko-produk', 'id' => yii::$app->user->identity->id]) ?>">
                <i class="fas fa-fw fa-box"></i>
                <span>Produk</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/toko/promo', 'id' => yii::$app->user->identity->id]) ?>">
                <i class="fa-solid fa-tags"></i>
                <span>Promo</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= \yii\helpers\Url::to(['/toko/pengaturan-toko', 'id' => yii::$app->user->identity->id]) ?>">
                <i class="fa fa-fw fa-cogs"></i>
                <span>Pengaturan Toko</span></a>
        </li>
    <?php endif ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        Addons
    </div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> -->

    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>