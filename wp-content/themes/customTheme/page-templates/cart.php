<?php
/*=================
Template Name: CART
===================*/
get_header('wordpress');

$postId = get_the_ID();


$methods_title = get_field('methods_title', $postId);
$methods_description = get_field('methods_description', $postId);
$methods_icons = get_field('methods_icons', $postId);
$methods_disclaimer = get_field('methods_disclaimer', $postId);

$featured_products = [
    'title' => get_field('featured_title', $postId),
    'subtitle' => get_field('featured_subtitle', $postId),
    'main' => get_field('main_featured', $postId),
    'products' => get_field('products', $postId)
];
?>
<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<section class="breadcrum top">
    <div class="container">
        <p><a href="<?php get_home_url(); ?>">Inicio </a>/ Tienda</p>
    </div>
</section>

<section class="cart-title">
    <div class="container">
        <h1>TIENDA</h1>
    </div>
</section>

<section class="cart">
    <div class="container">
        <div class="cart__products">
            <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                        /**
                         * Filter the product name.
                         *
                         * @since 2.1.0
                         * @param string $product_name Name of the product in the cart.
                         * @param array $cart_item The product in the cart.
                         * @param string $cart_item_key Key for the product in the cart.
                         */
                        $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                                <div class="cart__products__item">
                                    <div class="wrapper">
                                        <div class="product-thumbnail">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
            
                                            if ( ! $product_permalink ) {
                                                echo $thumbnail; // PHPCS: XSS ok.
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                                            }
                                            ?>
                                        </div>
                                        <div class="wrapper__container">
                                            <div class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( $product_name . '&nbsp;' );
                                                } else {
                                                    echo '<p class="title">'.explode('-', $product_name)[0].'</p>';
                                                    echo '<p class="info">Talla: '.$_product->get_attributes()['pa_talla'].'</p>';
                                                    echo '<p class="info">Color: '.$_product->get_attributes()['pa_color'].'</p>';
                                                }
            
                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
            
                                                // Meta data.
                                                echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.
            
                                                // Backorder notification.
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                                }
                                                ?>
                                            </div>
                                            <div class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                                                
                                                <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $min_quantity = 1;
                                                    $max_quantity = 1;
                                                } else {
                                                    $min_quantity = 0;
                                                    $max_quantity = $_product->get_max_purchase_quantity();
                                                }
            
                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $max_quantity,
                                                        'min_value'    => $min_quantity,
                                                        'product_name' => $product_name,
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                                ?>
                                            </div>
                                            <div class="product-remove">
                                                <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Eliminar</a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            /* translators: %s is the product name */
                                                            esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                ?>
                                            </div>
                                            <!-- <div class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                                ?>
                                            </div> -->
                                        </div>
                                    </div>
    
    
                                    <div class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                        <?php
                                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                        ?>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                    ?>

                    <?php do_action( 'woocommerce_cart_contents' ); ?>

                    <div class="update-cart">
                        <div class="actions">

                            <!-- <?php if ( wc_coupons_enabled() ) { ?>
                                <div class="coupon">
                                    <label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Código promocional:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                </div>
                            <?php } ?> -->

                            <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Actualizar carrito', 'woocommerce' ); ?>"><?php esc_html_e( 'Actualiar carrito', 'woocommerce' ); ?></button>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>

                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </div>
                    </div>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
            <div class="cart__products__paymethods">
                <p class="cart__products__paymethods--title"><?php echo $methods_title; ?></p>
                <p class="cart__products__paymethods--description"><?php echo $methods_description; ?></p>
                <div class="methods">
                    <?php
                    $rows = get_field('repeater_field_name');
                    if( $methods_icons ) {
                        foreach( $methods_icons as $icon ) {
                            $image = $icon['icon'];
                            ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            <?php
                        }
                    }
                    ?>
                </div>
                <p class="cart__products__paymethods--description"><?php echo $methods_disclaimer; ?></p>
            </div>
        </div>
        <div class="cart__info">
            <p class="cart__info__title">Resumen compra</p>
            <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
            <div class="cart_totals<?php echo ( WC()->customer->has_calculated_shipping() ) ? ' calculated_shipping' : ''; ?>">
                <?php do_action( 'woocommerce_before_cart_totals' ); ?>
                <div class="cart-subtotal">
                    <div><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div>
                    <div data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></div>
                </div>
                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <div><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
                        <div data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
                    </div>
                <?php endforeach; ?>
                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                    <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                    <?php wc_cart_totals_shipping_html(); ?>
                    <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
                <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
                    <div class="shipping">
                        <div><?php esc_html_e( 'Envio', 'woocommerce' ); ?></div>
                        <div data-title="<?php esc_attr_e( 'Envio', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></div>
                    </div>
                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <div class="fee">
                        <div><?php echo esc_html( $fee->name ); ?></div>
                        <div data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></div>
                    </div>
                <?php endforeach; ?>

                <?php
                if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text  = '';

                    if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                        /* translators: %s location. */
                        $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
                    }

                    if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                        foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                            ?>
                            <div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                <div><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                                <div data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="tax-total">
                            <div><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                            <div data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="coupon">
                    <!-- Añadir formulario de cupón aquí -->
                    <form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                        <?php if ( wc_coupons_enabled() ) { ?>
                            <div class="coupon__wrapper">
                                <div class="coupon__wrapper__title">
                                    <label for="coupon_code"><?php esc_html_e( 'Código promocional', 'woocommerce' ); ?></label>
                                </div>
                                <div class="coupon__wrapper__box">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter text', 'woocommerce' ); ?>" /> 
                                    <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Validar código promocional', 'woocommerce' ); ?>"><?php esc_attr_e( 'Validar código promocional', 'woocommerce' ); ?></button>
                                </div>
                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                            </div>
                        <?php } ?>
                    </form>
                </div>
                <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
                <div class="order-total">
                    <div><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
                    <div data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></div>
                </div>
                <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
                <div class="wc-proceed-to-checkout">
                    <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                </div>
                <?php do_action( 'woocommerce_after_cart_totals' ); ?>
            </div>
            
            <?php do_action( 'woocommerce_after_cart' ); ?>	
        </div>
    </div>
</section>

<?php do_shortcode("[bannerInterest]"); ?>

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

<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>
