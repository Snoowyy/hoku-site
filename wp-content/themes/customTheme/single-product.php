<?php
get_header('wordpress');

$postId = get_the_ID();
global $product;

$title = $product->get_name();
$short_desc = $product->get_short_description();
$price = $product->get_price_html();

$icon_tabs = get_field('icon_tabs', $postId);
$info_tabs = get_field('info_tabs', $postId);

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product', $product ); ?>>
    <div class="container">
        <div class="single-product__image">
            <?php
            do_action( 'woocommerce_before_single_product_summary' );
            ?>
        </div>
        <div class="single-product__summary">
            <div class="single-product__summary__titles">
            <div class="breadcrum dark">
                                <a href="/" class="breadcrum__item">Inicio</a>
                                <span class="separator">/</span>
                                <a href="<?php echo get_permalink(1032); ?>" class="breadcrum__item">Tienda</a>
                                <span class="separator">/</span>
                                <p class="breadcrum__item"><?php echo get_the_title(); ?></p>
                            </div>
                <h1 class="title"><?php echo $title; ?></h1>
                <p class="price"><?php echo $price; ?></p>
                <p class="description"><?php echo $short_desc; ?></p>
            </div>
            <div class="single-product__summary__options">
                <?php
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
                do_action( 'woocommerce_single_product_summary' );
                ?>
            </div>
            <div class="single-product__summary__icons">
                <?php
                if($icon_tabs){
                    foreach( $icon_tabs as $tab ) {
                        $icon = $tab['icon'];
                        $text = $tab['text'];
                        ?>
                        <div class="icon">
                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
                            <p><?php echo $text; ?></p>
                        </div>
                        <?php     
                    };
                }
                ?>
            </div>
            <div class="single-product__summary__tabs">
                <?php
                if($info_tabs){
                    foreach( $info_tabs as $tab ) {
                        $title = $tab['title'];
                        $content = $tab['content'];
                        ?>
                        <div class="tab">
                            <div class="tab__title">
                                <p><?php echo $title; ?></p>
                            </div>
                            <div class="tab__content">
                                <p><?php echo $content; ?></p>
                            </div>
                        </div>
                        <?php     
                    };
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php do_shortcode("[bannerInterest]"); ?>

<style>
    .header .menu__logo,
    .header .menu__icons #user_icon img,
    .header .menu__icons #search_icon svg,
    .header .menu__icons #cart_icon img,
    .header .menu__icons .hamburguer{
        filter: brightness(0);
    }

    .header.open .menu__icons,
    .header.scrolled .menu__logo,
    .header.scrolled .menu__icons #user_icon img,
    .header.scrolled .menu__icons #search_icon svg,
    .header.scrolled .menu__icons #cart_icon img,
    .header.scrolled .menu__icons .hamburguer{
        filter: unset;
    }
    .header:not(.scrolled) .header__content .menu__wrapper__items .menu-item a{
        color: var(--main-gray-dark, #1D1D1D);
    }
</style>


<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>