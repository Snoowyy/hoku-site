<?php
/*=================
Template Name: View order
===================*/
get_header('wordpress');

$postId = get_the_ID();

$order_id   = $_GET['order'];
$order      = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$item_count = $order->get_item_count();
?>

<div class="container">
    <h3 class="title">MI CUENTA</h3>
    <div class="desktop">
        <div class="desktop__navigation">
            <select id="navigation">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <option value="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="desktop__view-order">
            <h4 class="desktop__view-order__title">Pedidos</h4>
            <div class="desktop__view-order__detail">
                
            </div>
        </div>
    </div>
</div>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php do_action( 'woocommerce_auth_page_footer' ); ?>
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
<script>
    var dynamic = document.getElementById('navigation');
    dynamic.setAttribute('size', dynamic.childElementCount)
</script>
<?php get_footer(); ?>