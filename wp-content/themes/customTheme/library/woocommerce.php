<?php

function woocommerce_button_proceed_to_checkout() { ?>
    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
        <?php esc_html_e( 'Ir a pagar', 'woocommerce' ); ?>
    </a>
    <?php
}

add_filter( 'woocommerce_checkout_fields', 'misha_email_first', 999999);

function misha_email_first( $checkout_fields ) {
    unset($checkout_fields['billing']['billing_company']);
    unset($checkout_fields['billing']['billing_country']);
    unset($checkout_fields['billing']['billing_address_1']);
    unset($checkout_fields['billing']['billing_address_2']);
    unset($checkout_fields['billing']['billing_city']);
    unset($checkout_fields['billing']['billing_state']);
    unset($checkout_fields['billing']['billing_postcode']);
    unset($checkout_fields['billing']['billing_phone']);
    unset($checkout_fields['shipping']['shipping_first_name']);
    unset($checkout_fields['shipping']['shipping_last_name']);
    unset($checkout_fields['shipping']['shipping_company']);
    // unset($checkout_fields['shipping']['shipping_country']);
    // unset($checkout_fields['order']['order_comments']);

	return $checkout_fields;
}

add_filter('woocommerce_checkout_get_value','__return_empty_string',10);

// Remover el hook original
remove_action('woocommerce_checkout_before_customer_details', array( 'mailpoet_woocommerce_checkout_optin_present', 'checkoutCheckbox' ));

add_filter( 'woocommerce_cart_shipping_method_full_label', 'sww_wc_free_shipping_label', 10, 2 ); 

function sww_wc_free_shipping_label( $label, $method ) {

	if ( 0 == $method->cost ) {
		$label = 'Gratis';
	}

	return $label;
}

/* Add to the functions.php file of your theme/plugin */

add_filter( 'woocommerce_order_button_text', 'wc_custom_order_button_text' ); 

function wc_custom_order_button_text() {
    return __( 'Realizar pago', 'woocommerce' ); 
}

// Añadir el hook en la nueva posición
// add_action('woocommerce_after_checkout_billing_form', array( 'mailpoet_woocommerce_checkout_optin', 'checkoutCheckbox' ));


// add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields', 998);

// function custom_woocommerce_billing_fields($fields) {

//     // Añadiendo un campo tipo select
//     $fields['billing_id_type'] = array(
//         'label' => __('Tipo de documento', 'woocommerce'),
//         'required' => true,
//         'clear' => true,
//         'type' => 'select',
//         'options' => array(
//             '' => __('Tipo de documento', 'woocommerce'),
//             'option_1' => __('Cédula de Ciudadania', 'woocommerce'),
//             'option_2' => __('Cédula de Extranjeria', 'woocommerce'),
//         ),
//         'class' => array('my-css-select'),
//         'priority' => 7,
//     );

//     // Añadiendo un campo tipo texto
//     $fields['billing_id_number'] = array(
//         'label' => __('Ingresa tu número de identificación', 'woocommerce'),
//         'placeholder' => _x('Ingresa tu número de identificación', 'placeholder', 'woocommerce'),
//         'required' => true,
//         'clear' => true,
//         'type' => 'text',
//         'class' => array('my-css-text'),
//         'priority' => 8,
//     );

//     return $fields;
// }

// add_filter('woocommerce_shipping_fields', 'custom_woocommerce_shipping_fields', 999);

// function custom_woocommerce_shipping_fields($fields) {

//     // Añadiendo un campo tipo texto
//     $fields['shipping_telephone'] = array(
//         'label' => __('Teléfono', 'woocommerce'),
//         'placeholder' => _x('Teléfono', 'placeholder', 'woocommerce'),
//         'required' => false,
//         'clear' => true,
//         'type' => 'text',
//         'class' => array('my-css-text'),
//         'priority' => 90,
//     );

//     // Añadiendo un campo tipo texto
//     $fields['same_address'] = array(
//         'label' => __('Direccion misma que envio', 'woocommerce'),
//         'required' => false,
//         'clear' => true,
//         'type' => 'checkbox',
//         'class' => array('my-css-text'),
//         'priority' => 91,
//     );

//     // Añadiendo un campo tipo texto
//     $fields['shipping_gift_option'] = array(
//         'label' => __('Enviar como regalo', 'woocommerce'),
//         'required' => false,
//         'clear' => true,
//         'type' => 'checkbox',
//         'class' => array('my-css-text'),
//         'priority' => 92,
//     );

//     return $fields;
// }

// add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

// function custom_checkout_field_update_order_meta($order_id) {
//     if (!empty($_POST['billing_id_type'])) {
//         update_post_meta($order_id, 'billing_id_type', sanitize_text_field($_POST['billing_id_type']));
//     }
//     if (!empty($_POST['billing_id_number'])) {
//         update_post_meta($order_id, 'billing_id_number', sanitize_text_field($_POST['billing_id_number']));
//     }
//     if (!empty($_POST['shipping_phone'])) {
//         update_post_meta($order_id, 'shipping_phone', sanitize_text_field($_POST['shipping_phone']));
//     }
//     update_post_meta($order_id, 'same_address', isset($_POST['same_address']) ? 'Si' : 'No');
//     update_post_meta($order_id, 'shipping_gift_option', isset($_POST['shipping_gift_option']) ? 'Si' : 'No');
// }

// add_action('woocommerce_admin_order_data_after_billing_address', 'custom_checkout_field_display_admin_order_meta', 10, 1);

// function custom_checkout_field_display_admin_order_meta($order){
//     $id_number = get_post_meta($order->get_id(), 'billing_id_number', true);
//     $id_type_value = get_post_meta($order->get_id(), 'billing_id_type', true);
    
//     $id_type_options = array(
//         'option_1' => __('Cédula de Ciudadania', 'woocommerce'),
//         'option_2' => __('Cédula de Extranjeria', 'woocommerce'),
//     );
//     $id_type_label = isset($id_type_options[$id_type_value]) ? $id_type_options[$id_type_value] : '';

//     if ($id_type_label) {
//         echo '<p><strong>'.__('Tipo de Documento', 'woocommerce').':</strong> ' . $id_type_label . '</p>';
//     }
//     if ($id_number) {
//         echo '<p><strong>'.__('Número de Identificación', 'woocommerce').':</strong> ' . $id_number . '</p>';
//     }
// }

// add_action('woocommerce_admin_order_data_after_shipping_address', 'custom_shipping_field_display_admin_order_meta', 10, 1);

// function custom_shipping_field_display_admin_order_meta($order) {
//     $phone = get_post_meta($order->get_id(), 'shipping_phone', true);

//     if ($phone) {
//         echo '<p><strong>'.__('Teléfono de Envío', 'woocommerce').':</strong> ' . $phone . '</p>';
//     }
//     $same_address = get_post_meta($order->get_id(), 'same_address', true) === 'Si' ? 'Sí' : 'No';
//     echo '<p><strong>'.__('Dirección igual que envío', 'woocommerce').':</strong> ' . $same_address . '</p>';
//     $gift = get_post_meta($order->get_id(), 'shipping_gift_option', true) === 'Si' ? 'Sí' : 'No';
//     echo '<p><strong>'.__('Enviar como regalo', 'woocommerce').':</strong> ' . $gift . '</p>';
// }

// add_filter('woocommerce_shipping_fields', 'custom_required_shipping_fields');

// function custom_required_shipping_fields($fields) {
//     foreach ($fields as $key => $field) {
//         $fields[$key]['required'] = true;
//     }

//     return $fields;
// }