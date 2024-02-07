<?php
/*=================
Template Name: CHECKOUT
===================*/
get_header('wordpress');

$postId = get_the_ID();

global $checkout;
$checkout = WC()->checkout();
?>

<section class="checkout-section">
    <div class="container">
        <h1 class="checkout-section__title">Finalizar compra</h1>
        <div class="checkout-section__info">
            <table class="shop_table woocommerce-checkout-review-order-table">
                <thead>
                    <tr>
                        <th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                        <th class="product-total"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    do_action( 'woocommerce_review_order_before_cart_contents' );

                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            ?>
                            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <td class="product-name">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '&nbsp;'; ?>
                                    <?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </td>
                                <td class="product-total">
                                    <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    do_action( 'woocommerce_review_order_after_cart_contents' );
                    ?>
                </tbody>
                <tfoot>

                    <tr class="cart-subtotal">
                        <th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_subtotal_html(); ?></td>
                    </tr>

                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                        <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                            <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

                        <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

                        <?php wc_cart_totals_shipping_html(); ?>

                        <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

                    <?php endif; ?>

                    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                        <tr class="fee">
                            <th><?php echo esc_html( $fee->name ); ?></th>
                            <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                        <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                            <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                                <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                    <th><?php echo esc_html( $tax->label ); ?></th>
                                    <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr class="tax-total">
                                <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                                <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

                    <tr class="order-total">
                        <th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                        <td><?php wc_cart_totals_order_total_html(); ?></td>
                    </tr>

                    <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

                </tfoot>
            </table>
        </div>
        <div class="checkout-section__wrapper">
            <?php
            /**
             * Checkout Form
             *
             * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
             *
             * HOWEVER, on occasion WooCommerce will need to update template files and you
             * (the theme developer) will need to copy the new files to your theme to
             * maintain compatibility. We try to do this as little as possible, but it does
             * happen. When this occurs the version of the template file will be bumped and
             * the readme will list any important changes.
             *
             * @see https://docs.woocommerce.com/document/template-structure/
             * @package WooCommerce\Templates
             * @version 3.5.0
             */
            
            if ( ! defined( 'ABSPATH' ) ) {
                exit;
            }
            
            do_action( 'woocommerce_before_checkout_form', $checkout );
            
            // If checkout registration is disabled and not logged in, the user cannot checkout.
            if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
                echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'Debes iniciar sesión para poder terminar tu compra.', 'woocommerce' ) ) );
                return;
            }
            
            ?>
            
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
            
                <?php if ( $checkout->get_checkout_fields() ) : ?>
            
                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
            
                    <div class="col2-set" id="customer_details">
                        <div class="col-1">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
            
                        <div class="col-2">
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                        </div>
                    </div>
            
                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            
                <?php endif; ?>
                
                <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
                
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                
                <div id="order_review" class="woocommerce-checkout-review-order checkout-section__wrapper__item">
                    <h3 id="order_review_heading" class="title"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
            
                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            
            </form>
            
            <?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
        </div>
    </div>
</section>




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
    input[type="checkbox"]:checked+label::after, .noptin-integration-subscription-checkbox.checked::after, .checkbox.checked::after {
        top: 6px;
    }
</style>

<?php get_footer(); ?>
