<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('/wp-content/themes/customTheme/images/Lifestyle.jpg');
                ">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="/wp-content/themes/customTheme/images/Lifestyle.jpg" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts">
                            <p class="title">PASO A LA ELEGANCIA</p>
                            <p class="description">Encuentra el par perfecto en nuestra colección de zapatos. Comodidad y estilo que te harán destacar.</p>
                            <a href="#" class="button">Descubre más</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('/wp-content/themes/customTheme/images/Lifestyle3.jpg');
                ">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="/wp-content/themes/customTheme/images/Lifestyle3.jpg" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts">
                            <p class="title">PASO A LA ELEGANCIA</p>
                            <p class="description">Encuentra el par perfecto en nuestra colección de zapatos. Comodidad y estilo que te harán destacar.</p>
                            <a href="#" class="button">Descubre más</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('/wp-content/themes/customTheme/images/Lifestyle.jpg');
                ">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="/wp-content/themes/customTheme/images/Lifestyle.jpg" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts">
                            <p class="title">PASO A LA ELEGANCIA</p>
                            <p class="description">Encuentra el par perfecto en nuestra colección de zapatos. Comodidad y estilo que te harán destacar.</p>
                            <a href="#" class="button">Descubre más</a>
                        </div>
                    </div>
                </div>
            </div>
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

<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<footer class="footer">
    <div class="footer__content container">
        <div class="main">
            <?php echo wp_nav_menu(array( 'theme_location' => 'footer-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'legal-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'help-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'social-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
        </div>
        <div class="foot">
            <?php echo wp_nav_menu(array( 'theme_location' => 'contact-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
        </div>
    </div>
</footer>

<?php wp_footer() ?>