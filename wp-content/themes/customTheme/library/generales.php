<?php
add_filter( 'woocommerce_output_related_products_args', 'productos_relacionados_personalizados' );

function productos_relacionados_personalizados( $args ) {
    $args['posts_per_page'] = 3; // Número de productos relacionados para mostrar.
    $args['columns'] = 3; // Número de columnas en las que se muestran los productos.
    return $args;
}

function thenga_single_add_to_cart_text( $text ) {
    return __( 'Agregar a la bolsa de compra', 'textdomain' );
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'thenga_single_add_to_cart_text', 10, 1 );

/*==============menus y widgets========================*/

add_theme_support('nav-menus');

if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __( 'Footer Menu' ),
            'legal-menu' => __( 'Legal Menu' ),
            'help-menu' => __( 'Help Menu' ),
            'social-menu' => __( 'Social Menu' ),
            'contact-menu' => __( 'Contact Menu' )
        )
    );
}

add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);

function my_wp_nav_menu_items( $items, $args ) {
    $menu = wp_get_nav_menu_object($args->menu);
    
    if( $args->theme_location == 'header-menu' ) {
        $logo = get_field('logo_image', $menu);
        $userLogo = get_field('user_image', $menu);
        $searchLogo = get_field('search_image', $menu);
        $cartLogo = get_field('cart_image', $menu);

        $html_logo =
        '<div class="menu__logo">
            <a href="'.home_url().'">
                <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
            </a>
        </div>';

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <ul>
                    '.$items.'
                    <li class="menu-icon">
                        <a href="/login"><div id="user_icon" class="icon">
                            <img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" />
                            <p>Mi Cuenta</p>
                        </div></a>
                    </li>
                    <li class="menu-icon">
                        <div id="search_icon" class="icon">
                            '.do_shortcode('[fibosearch]').'
                        </div>
                    </li>
                </ul>
            </div>
        </div>';

        $icons_wrapper =
        '<div class="menu__icons">
            <div id="user_icon" class="icon">
                <a href="/login"><img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" /></a>
            </div>
            <div id="search_icon" class="icon">
                '.do_shortcode('[fibosearch]').'
            </div>
            <div id="cart_icon" class="icon">
                <img src="'.$cartLogo['url'].'" alt="'.$cartLogo['alt'].'" />
            </div>
            <div class="hamburguer">
                <span id="first_bar" class="hamburguer__bar"></span>
                <span id="second_bar" class="hamburguer__bar"></span>
                <span id="third_bar" class="hamburguer__bar"></span>
            </div>
        </div>
        <script>
        document.getElementById("cart_icon").addEventListener("click", function() {
            var backgroundBlur = document.querySelector(".background-blur");
            var sideCart = document.getElementById("side-cart");
            
            if (sideCart.classList.contains("open")) {
                sideCart.classList.remove("open");
                backgroundBlur.style.display = "none"; // Oculta el fondo con desenfoque
            } else {
                sideCart.classList.add("open");
                backgroundBlur.style.display = "block"; // Muestra el fondo con desenfoque
            }
        });
       </script>';

        $items = $html_logo . $items_wrapper . $icons_wrapper;
    }
    else if( $args->theme_location == 'footer-menu' ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations['footer-menu'];
        $menu_object = wp_get_nav_menu_object($menu_id);
        $menu_name = $menu_object->name;

        $logo = get_field('logo_image', $menu);
        $html_logo =
        '<div class="menu__logo">
            <a href="'.home_url().'">
                <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
            </a>
        </div>';

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <p class="title">' . $menu_name . '</p>
                <ul>
                    '.$items.'
                </ul>
            </div>
        </div>';

        $items = $html_logo . $items_wrapper;
    }else if( $args->theme_location == 'legal-menu' ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations['legal-menu'];
        $menu_object = wp_get_nav_menu_object($menu_id);
        $menu_name = $menu_object->name;

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <p class="title">' . $menu_name . '</p>
                <ul>
                    '.$items.'
                </ul>
            </div>
        </div>';

        $items = $items_wrapper;
    }else if( $args->theme_location == 'help-menu' ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations['help-menu'];
        $menu_object = wp_get_nav_menu_object($menu_id);
        $menu_name = $menu_object->name;

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <p class="title">' . $menu_name . '</p>
                <ul>
                    '.$items.'
                </ul>
            </div>
        </div>';

        $items = $items_wrapper;
    }else if( $args->theme_location == 'social-menu' ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations['social-menu'];
        $menu_object = wp_get_nav_menu_object($menu_id);
        $menu_name = $menu_object->name;

        $socialRepeater = get_field('social_medias', $menu);

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <p class="title">' . $menu_name . '</p>
                <div class="item">';
                    foreach( $socialRepeater as $social ) {
                        $logo = $social['social_image'];
                        $url = $social['social_url'];
                        $items_wrapper .=
                        '<a href="'.$url.'" target="_blank"  class="items__logo">
                            <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
                        </a>';            
                    };
                    $items_wrapper .=
                '</div>
            </div>
        </div>';

        $items = $items_wrapper;
    }else if( $args->theme_location == 'contact-menu' ){
        $locations = get_nav_menu_locations();
        $menu_id = $locations['contact-menu'];
        $menu_object = wp_get_nav_menu_object($menu_id);
        $menu_name = $menu_object->name;

        $phoneLabel = get_field('phone_label', $menu);
        $phoneNumber = get_field('phone_number', $menu);
        $email = get_field('email', $menu);
        $rights = get_field('rights', $menu);

        $items_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <div class="item">
                    <a class="tel" href="tel:'.$phoneNumber.'">'.$phoneLabel.'</a>
                    <a class="mail" href="mailto:'.$email.'">'.$email.'</a>
                </div>
                <div class="item">
                    <p class="rights">'.$rights.'</p>
                </div>
            </div>
        </div>';

        $items = $items_wrapper;
    }
    return $items;
}

function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );

function post_remove ()      //creating functions post_remove for removing menu item
{ 
   remove_menu_page('edit.php');
}

add_action('admin_menu', 'post_remove');   //adding action for triggering function call

function woocommerce_button_proceed_to_checkout() { ?>
    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
        <?php esc_html_e( 'Ir a pagar', 'woocommerce' ); ?>
    </a>
    <?php
}

add_filter( 'woocommerce_checkout_fields', 'misha_email_first' );

function misha_email_first( $checkout_fields ) {
    $checkout_fields['billing']['billing_email']['placeholder'] = '*Correo electrónico';
	$checkout_fields['billing']['billing_email']['priority'] = 4;
    
    $checkout_fields['billing']['billing_first_name']['placeholder'] = '*Nombre';
	$checkout_fields['billing']['billing_first_name']['priority'] = 5;

    $checkout_fields['billing']['billing_last_name']['placeholder'] = '*Apellidos';
	$checkout_fields['billing']['billing_last_name']['priority'] = 6;

    unset($checkout_fields['billing']['billing_company']);
    unset($checkout_fields['billing']['billing_country']);
    unset($checkout_fields['billing']['billing_address_1']);
    unset($checkout_fields['billing']['billing_address_2']);
    unset($checkout_fields['billing']['billing_city']);
    unset($checkout_fields['billing']['billing_state']);
    unset($checkout_fields['billing']['billing_postcode']);
    unset($checkout_fields['billing']['billing_phone']);

    $checkout_fields['shipping']['shipping_address_1']['placeholder'] = '*Ingrese su dirección';
	$checkout_fields['shipping']['shipping_address_1']['priority'] = 14;

    $checkout_fields['shipping']['shipping_address_2']['placeholder'] = 'Casa, apartamento, etc (Opcional)';
	$checkout_fields['shipping']['shipping_address_2']['priority'] = 15;

    $checkout_fields['shipping']['shipping_city']['placeholder'] = '*Ciudad';
	$checkout_fields['shipping']['shipping_city']['priority'] = 16;

	$checkout_fields['shipping']['shipping_state']['priority'] = 17;

    $checkout_fields['shipping']['shipping_postcode']['placeholder'] = 'Código postal';
	$checkout_fields['shipping']['shipping_postcode']['priority'] = 18;

    unset($checkout_fields['shipping']['shipping_first_name']);
    unset($checkout_fields['shipping']['shipping_last_name']);
    unset($checkout_fields['shipping']['shipping_company']);
    
    unset($checkout_fields['order']['order_comments']);

	return $checkout_fields;
}

add_filter('woocommerce_billing_fields', 'custom_woocommerce_billing_fields');

function custom_woocommerce_billing_fields($fields) {

    // Añadiendo un campo tipo select
    $fields['billing_id_type'] = array(
        'label' => __('Tipo de documento', 'woocommerce'),
        'required' => true,
        'clear' => false,
        'type' => 'select',
        'options' => array(
            '' => __('Tipo de documento', 'woocommerce'),
            'option_1' => __('Cédula de Ciudadania', 'woocommerce'),
            'option_2' => __('Cédula de Extranjeria', 'woocommerce'),
        ),
        'class' => array('my-css-select'),
        'priority' => 7,
    );

    // Añadiendo un campo tipo texto
    $fields['billing_id_number'] = array(
        'label' => __('Ingresa tu número de identificación', 'woocommerce'),
        'placeholder' => _x('Ingresa tu número de identificación', 'placeholder', 'woocommerce'),
        'required' => true,
        'clear' => true,
        'type' => 'text',
        'class' => array('my-css-text'),
        'priority' => 8,
    );

    return $fields;
}

add_filter('woocommerce_shipping_fields', 'custom_woocommerce_shipping_fields');

function custom_woocommerce_shipping_fields($fields) {

    // Añadiendo un campo tipo texto
    $fields['shipping_telephone'] = array(
        'label' => __('Teléfono', 'woocommerce'),
        'placeholder' => _x('Teléfono', 'placeholder', 'woocommerce'),
        // 'required' => false,
        'clear' => true,
        'type' => 'text',
        'class' => array('my-css-text'),
        'priority' => 90,
    );

    // Añadiendo un campo tipo texto
    $fields['shipping_same_address'] = array(
        'label' => __('Direccion misma que envio', 'woocommerce'),
        // 'required' => false,
        'clear' => true,
        'type' => 'checkbox',
        'class' => array('my-css-text'),
        'priority' => 91,
    );

    // Añadiendo un campo tipo texto
    $fields['shipping_gift'] = array(
        'label' => __('Enviar como regalo', 'woocommerce'),
        // 'required' => false,
        'clear' => true,
        'type' => 'checkbox',
        'class' => array('my-css-text'),
        'priority' => 92,
    );

    return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id) {
    if (!empty($_POST['billing_id_type'])) {
        update_post_meta($order_id, 'billing_id_type', sanitize_text_field($_POST['billing_id_type']));
    }
    if (!empty($_POST['billing_id_number'])) {
        update_post_meta($order_id, 'billing_id_number', sanitize_text_field($_POST['billing_id_number']));
    }
    if (!empty($_POST['shipping_phone'])) {
        update_post_meta($order_id, 'shipping_phone', sanitize_text_field($_POST['shipping_phone']));
    }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'custom_checkout_field_display_admin_order_meta', 10, 1);

function custom_checkout_field_display_admin_order_meta($order){
    $id_number = get_post_meta($order->get_id(), 'billing_id_number', true);
    $id_type_value = get_post_meta($order->get_id(), 'billing_id_type', true);
    
    $id_type_options = array(
        'option_1' => __('Cédula de Ciudadania', 'woocommerce'),
        'option_2' => __('Cédula de Extranjeria', 'woocommerce'),
    );
    $id_type_label = isset($id_type_options[$id_type_value]) ? $id_type_options[$id_type_value] : '';

    if ($id_type_label) {
        echo '<p><strong>'.__('Tipo de Documento', 'woocommerce').':</strong> ' . $id_type_label . '</p>';
    }
    if ($id_number) {
        echo '<p><strong>'.__('Número de Identificación', 'woocommerce').':</strong> ' . $id_number . '</p>';
    }
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'custom_shipping_field_display_admin_order_meta', 10, 1);

function custom_shipping_field_display_admin_order_meta($order) {
    $phone = get_post_meta($order->get_id(), 'shipping_phone', true);

    if ($phone) {
        echo '<p><strong>'.__('Teléfono de Envío', 'woocommerce').':</strong> ' . $phone . '</p>';
    }
}

add_filter('woocommerce_shipping_fields', 'custom_required_shipping_fields');

function custom_required_shipping_fields($fields) {
    foreach ($fields as $key => $field) {
        $fields[$key]['required'] = true;
    }

    return $fields;
}

/*widgets*/
// function widgets_de_tema()
// {

//     register_sidebar(array(
//         'name'          => 'widget de sidebar',
//         'id'            => 'widget_1',
//         'before_widget' => '<div class="widgetdiv">',
//         'after_widget'  => '</div>',
//         'before_title'  => '<h3 class="titulowidget">',
//         'after_title'   => '</h3>',
//     ));
// }
// add_action('widgets_init', 'widgets_de_tema');
// /*======================================*/


// function currentYear()
// {
//     return date('Y');
// }
// add_shortcode('Year', 'currentYear');


// add_action('get_header', 'buffer_start');

// add_action('wp_footer', 'buffer_end');
