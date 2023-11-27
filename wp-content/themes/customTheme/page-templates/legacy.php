<?php
/*=================
Template Name: LEGACY
===================*/
get_header('wordpress');

$postId = get_the_ID();

$banner_image = get_field('legacy_banner_image', $postId);
$banner_title = get_field('legacy_banner_title', $postId);
$banner_description = get_field('legacy_banner_description', $postId);

$icons = get_field('values_section', $postId);

$story_title = get_field('legacy_story_title', $postId);
$story_description = get_field('legacy_story_description', $postId);
$story_repeater = get_field('legacy_story_images', $postId);

$info_image = get_field('legacy_information_image', $postId);
$info_title = get_field('legacy_information_title', $postId);
$info_description = get_field('legacy_information_description', $postId);

?>
<section class="legacy-banner">
    <div class="container">
        <div class="legacy-banner__image">
            <img src="<?php echo $banner_image['url']; ?>" alt="<?php echo $banner_image['alt']; ?>">
        </div>
        <div class="legacy-banner__content">
            <p class="legacy-banner__content__title"><?php echo $banner_title; ?></p>
            <p class="legacy-banner__content__description"><?php echo $banner_description; ?></p>
        </div>
    </div>
</section>

<div class="container">
    <section class="values_section">
        <?php foreach ($icons as $key => $value) { ?>
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
</div>

<section class="story">
    <div class="container">
        <div class="story__content">
            <p class="story__content__title"><?php echo $story_title; ?></p>
            <p class="story__content__description"><?php echo $story_description; ?></p>
        </div>
        <div class="story__slider swiper">
            <div class="swiper-wrapper">
                <?php
                if($story_repeater){
                    foreach( $story_repeater as $story ) {
                        $image = $story['story_image'];
                        ?>
                        <div class="swiper-slide">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                        </div>
                        <?php     
                    };
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section class="legacy-info">
    <div class="container">
        <div class="legacy-info__image">
            <div class="legacy-info__image--filter">
                <img src="<?php echo $info_image['url']; ?>" alt="<?php echo $info_image['alt']; ?>">
            </div>
            <img src="<?php echo $info_image['url']; ?>" alt="<?php echo $info_image['alt']; ?>">
        </div>
        <div class="legacy-info__content">
            <p class="legacy-info__content__title"><?php echo $info_title; ?></p>
            <p class="legacy-info__content__description"><?php echo $info_description; ?></p>
        </div>
    </div>
</section>

<style>
    .header .menu__logo,
    .header .menu__icons {
        filter: brightness(0);
    }
    .header.open .menu__icons,
    .header.scrolled .menu__logo,
    .header.scrolled .menu__icons {
        filter: unset;
    }
    .header:not(.scrolled) .header__content .menu__wrapper__items .menu-item a{
        color: var(--main-gray-dark, #1D1D1D);
    }
</style>

<!-- End Featured Products Section-->
<?php do_shortcode("[bannerCategories]"); ?>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>