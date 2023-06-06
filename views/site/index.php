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

                    <div class="slider">
                        <div class="slides">

                            <?php
                            $no = 1;
                            foreach ($banners as $key => $banner) { ?>
                                <input type="radio" name="radio-btn" id="radio<?= $no++ ?>">
                            <?php } ?>

                            <?php
                            $no = 1;
                            foreach ($banners as $key => $banner) { ?>
                                <div class="slide <?= ($key == 0) ? "first" : "" ?>">
                                    <img src="<?= yii\helpers\Url::to(['/upload/' . $banner->image]) ?>" alt="">
                                </div>
                            <?php } ?>

                            <div class="navigation-auto">
                                <?php
                                $no = 1;
                                foreach ($banners as $key => $banner) { ?>
                                    <div class="auto-btn<?= $no++ ?>"></div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="navigation-manual">
                            <?php
                            $no = 1;
                            foreach ($banners as $key => $banner) { ?>
                                <label for="radio<?= $no++ ?>" class="manual-btn"></label>
                            <?php } ?>
                        </div>
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
                        <div class="col-lg-3 col-md-6 col-sm-6">
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
</div>