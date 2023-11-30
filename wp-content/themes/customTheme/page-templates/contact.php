<?php
/*=================
Template Name: CONTACT
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
                        <div class="swiper-slide__wrapper__texts">
                            <p class="title">CONTACTO</p>
                            <p class="description">¡Estamos aquí para ti! Nuestro equipo está dispuesto a responder a todas tus preguntas y necesidades. No dudes en ponerte en contacto con nosotros para un servicio excepcional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-form">
    <div class="container">
        <div class="contact-form__info"></div>
        <div class="contact-form__wrapper">
            <?php echo apply_shortcodes( '[contact-form-7 id="a283bed" title="Contact form"]' ); ?>
        </div>
    </div>
</section>

<!-- End Featured Products Section-->
<?php do_shortcode("[bannerCategories]"); ?>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>