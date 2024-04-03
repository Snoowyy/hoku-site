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
    global $custom_header_message_present;
    $menu = wp_get_nav_menu_object($args->menu);
    
    if( $args->theme_location == 'header-menu' ) {
        $message = get_field('header_message', $menu);
        $logo = get_field('logo_image', $menu);
        $userLogo = get_field('user_image', $menu);
        $searchLogo = get_field('search_image', $menu);
        $cartLogo = get_field('cart_image', $menu);

        if($message){
            $custom_header_message_present = true;
            // AQUI DEBO AÑADIR LA CLASE AL BODY... ESTA ES LA VALIDACION
            $gap = ' gap';
            $header__message =
            '<div class="menu__message">
                <p>'.$message.'</p>
            </div>';
        }else{
            $custom_header_message_present = false;
            $gap = '';
            $header__message = '';
        }

        $html_logo =
        '<div class="menu__logo'.$gap.'">
            <a href="'.home_url().'">
                <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
            </a>
        </div>';

        $items_wrapper =
        '<div class="menu__wrapper'.$gap.'">
            <div class="menu__wrapper__items">
                <ul>
                    '.$items.'
                    <li class="menu-icon">
                        <a href="/login"><div id="user_icon" class="icon">
                            <img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" />
                            <p>Mi Cuenta</p>
                        </div></a>
                    </li>
                </ul>
            </div>
        </div>';

        $icons_wrapper =
        '<div class="menu__icons'.$gap.'">
            <div id="user_icon" class="icon">
                <a href="/login"><img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" /></a>
            </div>
            <div id="search_icon" class="icon">
                '. do_shortcode('[fibosearch]') .'
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

        $items = $header__message . $html_logo . $items_wrapper . $icons_wrapper;
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

// Agrega el filtro `body_class`
add_filter('body_class', 'add_custom_body_class');

function add_custom_body_class($classes) {
    global $custom_header_message_present;

    if ($custom_header_message_present) {
    }
    $classes[] = 'header__message'; // Agrega tu clase personalizada

    return $classes;
}

add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );

function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}

add_action('admin_menu', 'post_remove');

function post_remove (){ 
   remove_menu_page('edit.php');
}

add_action('wp_ajax_update_cart_item_qty', 'update_cart_item_quantity');
add_action('wp_ajax_nopriv_update_cart_item_qty', 'update_cart_item_quantity');

function update_cart_item_quantity() {
    check_ajax_referer('update-cart-item-qty', 'security');

    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);

    if ($quantity > 0 && WC()->cart->set_quantity($cart_item_key, $quantity)) {
        wp_send_json_success(['message' => 'Carrito actualizado.']);
    } else {
        wp_send_json_error(['message' => 'Error al actualizar el carrito.']);
    }
}
