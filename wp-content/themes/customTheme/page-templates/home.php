<?php
/*=================
Template Name: HOME
===================*/
get_header('wordpress');

$postId = get_the_ID();
$support = [
    'title' => get_field('support_title', $postId),
    'detail' => get_field('support_detail', $postId),
    'image' => get_field('support_image', $postId),
];
$values = get_field('values_section', $postId);
$categories = get_field('categories_section', $postId);
$featured_products = [
    'title' => get_field('featured_title', $postId),
    'subtitle' => get_field('featured_subtitle', $postId),
    'main' => get_field('main_featured', $postId),
    'products' => get_field('products', $postId)
];
$carrousel = get_field('carrousel', $postId);

?>
<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <?php foreach ($carrousel as $slide) { ?>
                <div class="swiper-slide">
                    <div class="swiper-slide__wrapper" style="
                        background-image: url('<?= $slide['image']?>');">
                        <div class="container">
                            <div class="swiper-slide__wrapper__image">
                                <img src="<?= $slide['image']?>" alt="">
                            </div>
                            <div class="swiper-slide__wrapper__texts">
                                <p class="title"><?= $slide['title'] ?></p>
                                <p class="description"><?= $slide['description']?></p>
                                <a href="<?= $slide['cta']?>" class="button">Descubre más</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>

        </div>
        <div class="scroll-bar">
            <div id="main_banner_slider_prev" class="swiper-button-prev"></div>
            <span class="counter">01</span>
            <div class="swiper-scrollbar"></div>
            <span id="max_slides" class="counter">00</span>
            <div id="main_banner_slider_next" class="swiper-button-next"></div>
        </div>
    </div>
</section>
<div class="container">
    <!-- Init Support Section -->
    <section class="support_section">
        <div class="support_section__image">
            <img src="<?= $support['image'] ?>" alt="">
        </div>
        <div class="support_section__content">
            <h2 class="support_section__content__title">
                <?= $support['title'] ?>
            </h2>
            <span class="support_section__content__detail">
                <?= $support['detail'] ?>
            </span>
            <div class="support_section__content__button">
                <a>Ver productos</a>
            </div>
        </div>
    </section>
    <!-- End Support Section -->
    <!-- Init Values Section -->
    <section class="values_section">
        <?php foreach ($values as $key => $value) { ?>
            <?php if ($key != 0 && wp_is_mobile()): ?>
            <hr class="values_section__divider"></hr>
            <?php endif; ?>
            <div class="values_section__value">
                <img src="<?= $value['value_image']?>" class="values_section__value__image">
                <h5 class="values_section__value__title"><?= $value['value_title']?></h5>
                <span class="values_section__value__detail"><?= $value['value_detail']?></span>
            </div>
        <?php } ?>
    </section>
    <!-- End Values Section -->
    <!-- Init Featured Products Section -->
</div>
<section class="featured_section">
    <div class="container">
        <span class="featured_section__subtitle"> <?= $featured_products['subtitle'] ?> </span>
        <h2 class="featured_section__title"> <?= $featured_products['title'] ?> </h2>
        <?php if( $featured_products['main'] ): ?>
        <div class="featured_section__main">
            <div class="featured_section__main__image">
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_products['main']->ID ), 'single-post-thumbnail' ); ?>
                <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $featured_products['main']->post_title ); ?>">
            </div>
            <div class="featured_section__main__details">
                <?php $product = wc_get_product($featured_products['main']->ID); ?>
                <h1 class="featured_section__main__details__name"><?php echo esc_html( $featured_products['main']->post_title); ?></h1>
                <?php echo $product->get_price_html(); ?>
                <span class="featured_section__main__details__content">
                    <?php echo $product->get_short_description(); ?>
                </span>
                <a href="<?php echo $product->get_permalink(); ?>" class="featured_section__main__details__link">Descubrir</a>
            </div>
        </div>
        <?php endif; ?>
        <div class="featured_section__slider swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php foreach ($featured_products['products'] as $product) { 
                $product_data = wc_get_product($product->ID)?>
                <div class="swiper-slide">
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' ); ?>
                    <a href="<?php echo get_permalink($product->ID); ?>">
                        <div class="image">
                            <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $product->post_title ); ?>">
                        </div>
                        <h6 class="title"><?= $product->post_title ?></h6>
                        <?php echo $product_data->get_price_html(); ?>
                    </a>
                </div>
                <?php } ?>
                <!-- If we need scrollbar -->
            </div>
            <div class="swiper-scrollbar"></div>
        </div>
        
        <div class="featured_section__button">
        <button>Ver todos los productos</button>
        </div>
    </div>
</section>
<!-- End Featured Products Section-->
<?php do_shortcode("[bannerCategories]"); ?>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>