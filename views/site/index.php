<div class="site-index">
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>KATEGORI</span>
                        </div>
                        <ul>
                            <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop/" ?>">Semua Kategori</a></li>
                            <?php foreach ($categories as $category) : ?>
                                <li><a href="<?= \Yii::$app->request->baseUrl . "/site/shop?category=" . $category->name ?>"><?= $category->name ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <!-- <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" name="search" id="search" placeholder="Apa yang kamu butuhkan?">
                                <button class="site-btn"><i class="fa fa-search fa-lg"></i></button>
                            </form>
                        </div>

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div> -->
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-inner">
                            <?php foreach ($banners as $key => $banner) { ?>
                                <div class="carousel-item <?= ($key == 0) ? "active" : "" ?>">
                                    <img src="<?= yii\helpers\Url::to(['/upload/' . $banner->image]) ?>" alt="" style="width: 150vh;height:80vh">
                                </div>
                            <?php } ?>
                        </div>
                        <?php if ($bannerCount != 1) { ?>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php foreach ($categories as $category) : ?>
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="<?= \Yii::$app->request->BaseUrl . "/upload/" . $category->img ?>" style="background-color:#f5f5f5;">
                                <h5><a href="<?= \Yii::$app->request->baseUrl . "/site/shop?category=" . $category->name ?>"><?= $category->name ?></a></h5>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>PRODUK UNGGULAN</h2>
                    </div>
                    <!-- <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="row featured__filter">
                <?php foreach ($lates as $produk) :
                    $promo = app\models\Promo::find()->where(['products_id' => $produk->id])->andWhere(['>=', 'date_end', date('Y-m-d')])->one();
                ?>
                    <?= $this->render('_item', ['model' => $produk, 'promo' => $promo]); ?>
                <?php endforeach ?>
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <!-- <div class="banner mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="<?= Yii::$app->request->baseUrl . "/ogani-master/img/banner/banner-1.jpg" ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="<?= Yii::$app->request->baseUrl . "/ogani-master/img/banner/banner-2.jpg" ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner End -->
</div>