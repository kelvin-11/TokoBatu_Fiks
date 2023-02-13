 <!-- Sidebar -->
 <div class="sidebar sidebar-style-2">
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <div class="user">
                 <div class="avatar-sm float-left mr-2">
                     <img src="<?= yii\helpers\Url::to(['/img/loli2.jpg/']) ?>" alt="" class="avatar-img rounded-circle">
                 </div>
                 <div class="info">
                     <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                         <span>
                             <?= Yii::$app->user->identity->name ?>
                             <span class="user-level">Administrator</span>
                             <span class="caret"></span>
                         </span>
                     </a>
                     <div class="clearfix"></div>

                     <div class="collapse in" id="collapseExample">
                         <ul class="nav">
                             <li>
                                 <a href="#profile">
                                     <span class="link-collapse">My Profile</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="#edit">
                                     <span class="link-collapse">Edit Profile</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="#settings">
                                     <span class="link-collapse">Settings</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
             <ul class="nav nav-primary">
                 <li class="nav-item active">
                     <a href="<?= \yii\helpers\Url::to(['/admin/index']) ?>" class="collapsed" aria-expanded="false">
                         <i class="fas fa-home"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-section">
                     <span class="sidebar-mini-icon">
                         <i class="fa fa-ellipsis-h"></i>
                     </span>
                     <h4 class="text-section">Components</h4>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#base">
                         <i class="fa-brands fa-unity"></i>
                         <p>Produk</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="base">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/produk']) ?>">
                                     <span class="sub-item">Produk Admin</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/category']) ?>">
                                     <span class="sub-item">Category</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#jasa">
                         <i class="fa-solid fa-truck-fast"></i>
                         <p>Jasa Kirim</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="jasa">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/jasa']) ?>">
                                     <span class="sub-item">Index</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#sidebarLayouts">
                         <i class="fa-solid fa-coins"></i>
                         <p>Penjualan</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="sidebarLayouts">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/penjualan']) ?>">
                                     <span class="sub-item">Semua Penjualan</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#forms">
                         <i class="fa-solid fa-users"></i>
                         <p>Customer</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="forms">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/customer']) ?>">
                                     <span class="sub-item">Customer List</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#tables">
                         <i class="fa-solid fa-person-dots-from-line"></i>
                         <p>Penjual</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="tables">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/penjual']) ?>">
                                     <span class="sub-item">Index</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
                 <li class="nav-item">
                     <a data-toggle="collapse" href="#maps">
                         <i class="fa-solid fa-layer-group"></i>
                         <p>Laporan</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse" id="maps">
                         <ul class="nav nav-collapse">
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/produk-penjual']) ?>">
                                     <span class="sub-item">Produk Penjual</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/stok-produk']) ?>">
                                     <span class="sub-item">Stok Produk</span>
                                 </a>
                             </li>
                             <li>
                                 <a href="<?= \yii\helpers\Url::to(['/admin/jumlah-penjualan']) ?>">
                                     <span class="sub-item">Jumlah Penjualan</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- End Sidebar -->