<?php
/*=================
Template Name: View order
===================*/
get_header('wordpress');

$postId = get_the_ID();

$order_id   = $_GET['order'];
$order      = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

// Customer billing information details
$billing_address_1  = $order->get_billing_address_1();
$billing_address_2  = $order->get_billing_address_2();
$billing_city       = $order->get_billing_city();
$billing_state      = $order->get_billing_state();
$billing_postcode   = $order->get_billing_postcode();
$billing_phone   = $order->get_billing_phone();
$billing_country    = $order->get_billing_country();
// Customer shipping information details
$shipping_address_1  = $order->get_shipping_address_1();
$shipping_address_2  = $order->get_shipping_address_2();
$shipping_city       = $order->get_shipping_city();
$shipping_state      = $order->get_shipping_state();
$shipping_postcode   = $order->get_shipping_postcode();
$shipping_phone   = $order->get_shipping_phone();
$shipping_country    = $order->get_shipping_country();
$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>

<div class="container">
    <div class="desktop">
        <div class="desktop__navigation">
            <h3>MI CUENTA</h3>
            <select id="navigation">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <option value="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="desktop__order">
            <h4>Pedidos</h4>
            <p class="desktop__order__description">
                <?php
                    printf(
                        /* translators: 1: user display name 2: logout url */
                        wp_kses( __( 'Orden %1$s fue creada en %2$s su actual estado es %3$s', 'woocommerce' ), $allowed_html ),
                        '<b>' . esc_html( $order->get_id() ) . '</b>',
                        '<b>' . esc_html( wc_format_datetime( $order->get_date_created() ) ) . '</b>',
                        '<b>' . esc_html( wc_get_order_status_name( $order->get_status() ) ) . '</b>'
                    );
                ?>
            </p>
            <a class="desktop__order__return">Volver</a>
            <div class="desktop__order__detail">
                <h4>Detalles de la orden</h4>
                <?php foreach ($order->get_items() as $item_id => $item ) {
                    $product = $item->get_product();
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_parent_id() ), 'single-post-thumbnail' );
                ?>
                    <div class="desktop__order__detail__product">
                        <img src="<?= $image[0]; ?>" alt="">
                        <div class="desktop__order__detail__product__detail">
                            <h5><?= $product->get_title() ?></h5>
                            <p>Cantidad: <?= $item->get_quantity() ?></p>
                            <p><?= $product->get_attribute_summary() ?></p>
                            <p><b>Subtotal: <?= get_woocommerce_currency_symbol( get_woocommerce_currency() ) .number_format($item->get_subtotal()) ?></b></p>
                            <p>Metodo de pago:  Tarjeta de credito</p>
                            <p><b>Total: <?= get_woocommerce_currency_symbol( get_woocommerce_currency() ) .number_format($item->get_total()) ?></b></p>
                        </div>
                    </div>
                <?php }?>
                <h4>Dirección de envio</h4>
                <div class="desktop__order__detail__address">
                    <p><?= $shipping_address_1 ?></p>
                    <p><?= $shipping_address_2 ?></p>
                    <p><?= WC()->countries->countries[ $shipping_country ]; ?></p>
                    <p><?= $shipping_city ?></p>
                    <p><?= $shipping_postcode ?></p>
                    <p><?= $shipping_phone ?></p>
                </div>
                <h4>Dirección de facturación</h4>
                <div class="desktop__order__detail__address">
                    <p><?= $billing_address_1 ?></p>
                    <p><?= $billing_address_2 ?></p>
                    <p><?= WC()->countries->countries[ $billing_country ]; ?></p>
                    <p><?= $billing_city ?></p>
                    <p><?= $billing_postcode ?></p>
                    <p><?= $billing_phone ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php do_action( 'woocommerce_auth_page_footer' ); ?>
<style>
    .header .menu__logo,
    .header .menu__icons #user_icon img,
    .header .menu__icons #search_icon svg,
    .header .menu__icons #cart_icon img{
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
</script>
<?php get_footer(); ?>