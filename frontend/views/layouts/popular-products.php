<?php

use common\models\Constant;
use frontend\models\Category;
use frontend\models\Product;
use yii\bootstrap4\Html;

$categories = Category::find()
    ->where([
        'status' => Constant::STATUS_DEFAULT_ACTIVE,
        'availability' => Constant::STATUS_DEFAULT_ACTIVE,
    ])
    ->all();

?>
<div class="container">
    <div class="section-title style-2 wow animate__animated animate__fadeIn">
        <h3>Popular Products</h3>
        <ul class="nav nav-tabs links" id="myTab" role="tablist">
            <?php
            if ($categories) {
                $i = 1;
                foreach ($categories as $category) {
                    ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $i == 1 ? "active" : "" ?>" id="nav-tab-<?= $category->id ?>"
                                data-bs-toggle="tab"
                                data-bs-target="#tab-<?= $category->id ?>" type="button" role="tab"
                                aria-controls="tab-<?= $category->id ?>"
                                aria-selected="true"><?= $category->name ?>
                        </button>
                    </li>
                    <?php
                    $i++;
                }
            }
            ?>
        </ul>
    </div>
    <!--End nav-tabs-->
    <div class="tab-content" id="myTabContent">
        <?php
        if ($categories) {
            $i = 1;
            foreach ($categories as $category) {
                ?>
                <div class="tab-pane fade  <?= $i == 1 ? "show active" : "" ?>" id="tab-<?= $category->id ?>"
                     role="tabpanel" aria-labelledby="tab-<?= $category->id ?>">
                    <div class="row product-grid-4">
                        <?php
                        $products = Product::find()
                            ->where([
                                'category_id' => $category->id,
                                'status' => Constant::STATUS_DEFAULT_ACTIVE,
                                'availability' => Constant::STATUS_DEFAULT_ACTIVE,
                            ])
                            ->all();
                        if ($products) {
                            $total = count($products);
                            $i = 1;
                            foreach ($products as $product) {
                                ?>
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 <?= $i == $total ? "d-none d-xl-block" : "" ?>">
                                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                         data-wow-delay=".1s">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="#">
                                                    <?= Html::img($product->front_image_url, ['alt' => $product->name, 'class' => 'default-img']); ?>
                                                    <?= Html::img($product->back_image_url, ['alt' => $product->name, 'class' => 'hover-img']); ?>
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" class="action-btn"
                                                   href="#"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn" href="#"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                                   data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="<?= $product->badge->class ?>"><?= $product->badge->name ?> <?= Constant::getProductSalePercent($product->origin_price, $product->sale_price, 2) ?></span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="#"><?= $category->name ?></a>
                                            </div>
                                            <h2><a href="#"><?= $product->name ?></a></h2>
                                            <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">(4.0)</span>
                                            </div>
                                            <div>
                                                <span class="font-small text-muted"><?= Yii::t('app', 'By') ?> <a
                                                            href="#"><?= $product->owner->full_name ?></a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                <div class="product-price">
                                                    <span><?= $product->sale_price ?></span>
                                                    <span class="old-price"><?= $product->origin_price ?></span>
                                                </div>
                                                <div class="add-cart">
                                                    <a class="add" href="#"><i class="fi-rs-shopping-cart mr-5"></i><?= Yii::t('app', 'Add') ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end product card-->
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab <?= $category->id ?>>-->
                <?php
                $i++;
            }
        }
        ?>
    </div>
    <!--End tab-content-->
</div>