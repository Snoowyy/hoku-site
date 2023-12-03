<?php
/*=================
Template Name: Orders
===================*/
get_header('wordpress');

$postId = get_the_ID();

$my_orders_columns = apply_filters(
	'woocommerce_my_account_my_orders_columns',
	array(
		'order-number'  => esc_html__( 'Order', 'woocommerce' ),
		'order-date'    => esc_html__( 'Date', 'woocommerce' ),
		'order-status'  => esc_html__( 'Status', 'woocommerce' ),
		'order-total'   => esc_html__( 'Total', 'woocommerce' ),
		'order-actions' => '&nbsp;',
	)
);
$args = array(
    'customer_id' => get_current_user_id(),
    'limit' => -1, // to retrieve _all_ orders by this user
);
$customer_orders = wc_get_orders($args);
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
        <?php if ( $customer_orders ) : ?>
        <div class="desktop__orders">
            <h4>Pedidos</h4>
            <div class="desktop__orders__order__columns">
                <span>Orden</span>
                <span>Fecha</span>
                <span>Estado</span>
                <span>Total</span>
            </div>
            <?php foreach ( $customer_orders as $customer_order ) :
            $order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $item_count = $order->get_item_count();
            ?>
                <div class="desktop__orders__order">
                    <span><b><?php echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->id; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></b></span>
                    <span><time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time></span>
                    <span><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span>
                    <span><?php
                        /* translators: 1: formatted order total 2: total order items */
                        printf( _n( '%1$s por %2$s producto(s)', '%1$s for %2$s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?></span>
                    <?php
                    $actions = wc_get_account_orders_actions( $order );

                    if ( ! empty( $actions ) ) {
                        foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                            if($action['name'] == 'View') {
                                echo '<a class="button" href="' . '/view-order?order=' . $order->id . '" class="button ' . sanitize_html_class( $key ) . '">' . 'Ver pedido' . '</a>';
                            }
                        }
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
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
    var dynamic = document.getElementById('navigation');
    dynamic.setAttribute('size', dynamic.childElementCount)
</script>
<?php get_footer(); ?>