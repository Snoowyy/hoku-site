<?php
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
                        <div id="user_icon" class="icon">
                            <img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" />
                            <p>Mi Cuenta</p>
                        </div>
                    </li>
                    <li class="menu-icon">
                        <div id="search_icon" class="icon">
                            <img src="'.$searchLogo['url'].'" alt="'.$searchLogo['alt'].'" />
                            <p>Buscar</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>';

        $icons_wrapper =
        '<div class="menu__icons">
            <div id="user_icon" class="icon">
                <img src="'.$userLogo['url'].'" alt="'.$userLogo['alt'].'" />
            </div>
            <div id="search_icon" class="icon">
                <img src="'.$searchLogo['url'].'" alt="'.$searchLogo['alt'].'" />
            </div>
            <div id="cart_icon" class="icon">
                <img src="'.$cartLogo['url'].'" alt="'.$cartLogo['alt'].'" />
            </div>
            <div class="hamburguer">
                <span id="first_bar" class="hamburguer__bar"></span>
                <span id="second_bar" class="hamburguer__bar"></span>
                <span id="third_bar" class="hamburguer__bar"></span>
            </div>
        </div>';

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

