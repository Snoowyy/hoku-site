<?php
/*=================
Template Name: CONTACT
===================*/
get_header('wordpress');

$postId = get_the_ID();

$banner_image = get_field('contact_banner_image', $postId);
$banner_title = get_field('contact_banner_title', $postId);
$banner_description = get_field('contact_banner_description', $postId);

$info_repeater = get_field('contact_information', $postId);
?>

<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('<?php echo $banner_image['url']; ?>');">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="<?php echo $banner_image['url']; ?>" alt="<?php echo $banner_image['alt']; ?>">
                        </div>
                        <div class="swiper-slide__wrapper__texts">
                            <p class="title"><?php echo $banner_title; ?></p>
                            <p class="description"><?php echo $banner_description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-form">
    <div class="container">
        <div class="contact-form__info">
            <?php
            if( $info_repeater ) {
                foreach( $info_repeater as $info ) {
                    $title = $info['contact_info_title'];
                    $flex = $info['contact_flex'];
                    ?>
                    <div class="contact-form__info__item">
                        <p class="title"><?php echo $title; ?></p>
                        <?php 
                        if ($flex) {
                            foreach ($flex as $block) {
                                // Aquí puedes mostrar los datos de cada bloque flexible según su tipo
                                if ($block['acf_fc_layout'] === 'flex_email') {
                                    $email = $block['contact_flex_email'];
                                    ?>
                                    <a class="info" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                    <?php
                                } elseif ($block['acf_fc_layout'] === 'flex_telephone') {
                                    $country = $block['contact_flex_country'];
                                    $tel = $block['contact_flex_telephone'];
                                    ?>
                                    <a class="info" href="tel:<?php echo $country . $tel; ?>"><?php echo $country . ' ' . $tel; ?></a>
                                    <?php
                                } elseif ($block['acf_fc_layout'] === 'flex_address') {
                                    $address = $block['contact_flex_address'];
                                    ?>
                                    <p class="info"><?php echo $address; ?></p>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div><?php
                }
            }
            ?>
        </div>
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