<?php 
/*=================
Template Name: My Address
===================*/
get_header('wordpress');

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>
<div class="container">
    <div class="desktop">
        <h3>MI CUENTA</h3>
        <div class="desktop__container">
            <div class="desktop__navigation">
                <select onchange="redirectOnChange(this)">
                    <option value="/desktop">Escritorio</option>
                    <option value="/orders">Pedidos</option>
                    <option value="/address">Dirección</option>
                    <option value="/account">Detalles de la cuenta</option>
                    <option value="/desktop">Salir</option>
                </select>
                <div class="desktop__navigation__wrapper">
                    <a href="/desktop" class="active">Escritorio</a>
                    <a href="/orders">Pedidos</a>
                    <a href="/address">Dirección</a>
                    <a href="/account">Detalles de la cuenta</a>
                    <a href="/desktop">Salir</a>
                </div>
            </div>
            <div class="desktop__order">
				<h4>Dirección</h4>
				<div class="desktop__order__actions">
					<p class="desktop__order__actions__description">
						<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</p>
                    <a class="desktop__order__actions__return" href="/orders">Crear</a>
				</div>
				<div class="desktop__order__detail">
					<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
					<div class="desktop__order__detail__address__container">
					<?php endif; ?>
					
					<?php foreach ( $get_addresses as $name => $address_title ) : ?>
						<?php
							$address = wc_get_account_formatted_address( $name );
							$col     = $col * -1;
							$oldcol  = $oldcol * -1;
						?>
					
						<div class="u-column<?php echo $col < 0 ? 1 : 2; ?> col-<?php echo $oldcol < 0 ? 1 : 2; ?> desktop__order__detail__address">
							<h4><?php echo esc_html( $address_title ); ?></h4>
							<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?></a>
							<address>
								<?php
									echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
								?>
							</address>
						</div>
					
					<?php endforeach; ?>
					
					<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
					</div>
					<?php endif; ?>
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
<?php get_footer(); ?>
