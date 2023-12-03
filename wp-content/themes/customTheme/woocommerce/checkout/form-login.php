<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="w">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', esc_html__( '¿Tienes una cuenta?', 'woocommerce' ) ) . ' <a href="#" class="showlogin">' . esc_html__( 'Iniciar sesión', 'woocommerce' ) . '</a>', 'notice' ); ?>
</div>
<?php

woocommerce_login_form(
	array(
		'message'  => esc_html__( 'Si ya has comprado con nosotros antes, por favor ingresa tus datos a continuación. Si eres un cliente nuevo, por favor procede a la sección de Facturación.', 'woocommerce' ),
		'redirect' => wc_get_checkout_url(),
		'hidden'   => true,
	)
);
