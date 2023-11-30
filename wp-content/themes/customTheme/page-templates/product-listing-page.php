<?php
/*=================
Template Name: PLP
===================*/
get_header('wordpress');

$postId = get_the_ID();

?>
<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('/wp-content/themes/customTheme/images/Lifestyle2.jpg');">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="/wp-content/themes/customTheme/images/Lifestyle2.jpg" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts-categories">
                            <p class="title">TIENDA</p>
                            <p class="description">Descubre la elegancia y comodidad en nuestra colección de zapatos para hombre, perfectos para cualquier ocasión. ¡Compra ahora!.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <?php
        while (have_posts()) : the_post();
        the_content();
        endwhile;
    ?>
</div>
<?php do_shortcode("[bannerCategories]"); ?>
<?php do_shortcode("[featured_products]"); ?>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>