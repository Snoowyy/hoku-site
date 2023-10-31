<?php
/*==============menus y widgets========================*/

add_theme_support('nav-menus');

if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}

add_filter('wp_nav_menu_items', 'my_wp_nav_menu_items', 10, 2);

function my_wp_nav_menu_items( $items, $args ) {
    $menu = wp_get_nav_menu_object($args->menu);
    
    if( $args->theme_location == 'header-menu' ) {
        $logo = get_field('logo_image', $menu);
        $searchBarLabel = get_field('searchBar_label', $menu);
        $customButtonLabel = get_field('customButton_label', $menu);
        $customButtonPage = get_field('customButton_page', $menu);

        $html_logo =
        '<div class="menu-item-logo">
            <a href="'.home_url().'">
                <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
            </a>
            <div class="hamburguer">
                <div id="open_hamburguer" class="hamburguer__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M8.33325 8.33334H31.6666M8.33325 20H31.6666M8.33325 31.6667H31.6666" stroke="#F5F5F5" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div id="close_hamburguer" class="hamburguer__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <path d="M8.3335 8.33334L20.0002 20M20.0002 20L31.6668 8.33334M20.0002 20L8.3335 31.6667M20.0002 20L31.6668 31.6667" stroke="#F5F5F5" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>';

        preg_match_all('/<a[^>]+?href="([^">]+?)"[^>]*?>([^<]+?)<\/a>/', $items, $matches);
        
        $newItems = '';
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Para suprimir errores de formato HTML
        $dom->loadHTML(mb_convert_encoding($items, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);
        $links = $xpath->query('//li/a');

        foreach ($links as $link) {
            $postID = url_to_postid($link->getAttribute('href'));
            $featuredImgUrl = get_the_post_thumbnail_url($postID);
            
            if ($featuredImgUrl) {
                $imgElement = $dom->createElement('img');
                $imgElement->setAttribute('src', $featuredImgUrl);
                $imgElement->setAttribute('alt', '');

                $divElement = $dom->createElement('div');
                $divElement->setAttribute('class', 'image-wrapper');
                $divElement->appendChild($imgElement);

                $link->insertBefore($divElement, $link->firstChild);
                $svgString =
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M4 11.2L11.2 4M11.2 4V10.912M11.2 4H4.288" stroke="#F5F5F5" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>';

                $svgDom = new DOMDocument();
                $svgDom->loadXML($svgString);
                $svgElement = $dom->importNode($svgDom->documentElement, true);
                $link->insertBefore($svgElement, $link->firstChild);
            }

            $title = $link->getAttribute('title');
            if (!empty($title)) {
                $titlePElem = $dom->createElement('p', $title);
                $spanElem = $xpath->query('span', $link)->item(0);

                if ($spanElem) {
                    $titlePElem->setAttribute('class', 'description__anchor');
                    $link->insertBefore($titlePElem, $spanElem->nextSibling);
                    $svgString =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M2.50844 7.59996H12.6908M12.6908 7.59996L7.80326 12.4875M12.6908 7.59996L7.80326 2.71244" stroke="#F5F5F5" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>';

                    $svgDom = new DOMDocument();
                    $svgDom->loadXML($svgString);
                    $svgElement = $dom->importNode($svgDom->documentElement, true);
                    $titlePElem->appendChild($svgElement);

                } else {
                    $link->appendChild($titlePElem);
                }
                $link->removeAttribute('title');
            }

            $childNodes = $link->childNodes;

            foreach ($childNodes as $childNode) {
                if ($childNode->nodeName == "#text" && trim($childNode->nodeValue) != '') {
                    $pElem = $dom->createElement('p', $childNode->nodeValue);
                    $pElem->setAttribute('class', 'title');
                    $link->replaceChild($pElem, $childNode);
                }
            }
        }
        $newItems = $dom->saveHTML();

        $html_searchBar =
        '<div class="menu-item-searchBar">
            <div id="open_searchBar" class="open">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21.0002 21.5002L16.6572 17.1572M16.6572 17.1572C17.4001 16.4143 17.9894 15.5324 18.3914 14.5618C18.7935 13.5911 19.0004 12.5508 19.0004 11.5002C19.0004 10.4496 18.7935 9.40929 18.3914 8.43866C17.9894 7.46803 17.4001 6.58609 16.6572 5.84321C15.9143 5.10032 15.0324 4.51103 14.0618 4.10898C13.0911 3.70693 12.0508 3.5 11.0002 3.5C9.9496 3.5 8.90929 3.70693 7.93866 4.10898C6.96803 4.51103 6.08609 5.10032 5.34321 5.84321C3.84288 7.34354 3 9.37842 3 11.5002C3 13.622 3.84288 15.6569 5.34321 17.1572C6.84354 18.6575 8.87842 19.5004 11.0002 19.5004C13.122 19.5004 15.1569 18.6575 16.6572 17.1572Z" stroke="#055C94" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <input type="text" name="" id="search_input" placeholder="'.$searchBarLabel.'">
            <div id="close_searchBar" class="close">
                <div class="close__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <g opacity="0.69">
                            <path d="M3.33301 3.83301L7.99967 8.49967M7.99967 8.49967L12.6663 3.83301M7.99967 8.49967L3.33301 13.1663M7.99967 8.49967L12.6663 13.1663" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>';

        $html_customButton =
        '<div class="menu-item-customButton">
            <a href="'.$customButtonPage.'">'.$customButtonLabel.'</a>
        </div>';

        $languages = pll_the_languages(array('raw' => 1));
        $html_language = 
        '<div class="menu-item-languages">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                <path d="M7.99953 11.1665C7.84376 11.1668 7.69281 11.1126 7.57287 11.0132L3.57287 7.67986C3.43672 7.5667 3.35111 7.40409 3.33485 7.22781C3.3186 7.05152 3.37304 6.876 3.4862 6.73986C3.59936 6.60371 3.76197 6.5181 3.93825 6.50184C4.11453 6.48559 4.29005 6.54003 4.4262 6.65319L7.99953 9.63986L11.5729 6.75986C11.6411 6.70448 11.7195 6.66313 11.8037 6.63817C11.888 6.61322 11.9763 6.60516 12.0637 6.61445C12.151 6.62374 12.2357 6.65021 12.3127 6.69232C12.3898 6.73444 12.4578 6.79137 12.5129 6.85986C12.5739 6.92841 12.6202 7.00882 12.6487 7.09607C12.6772 7.18332 12.6874 7.27552 12.6787 7.3669C12.6699 7.45827 12.6424 7.54685 12.5978 7.62709C12.5532 7.70733 12.4925 7.7775 12.4195 7.83319L8.41953 11.0532C8.29614 11.1369 8.14827 11.1768 7.99953 11.1665Z" fill="#4A4A49"/>
            </svg>
            <select onchange="location = this.value;">';
        foreach($languages as $lang) {
            $selected = $lang['current_lang'] ? ' selected' : '';
            $html_language .= '<option value="' . $lang['url'] . '"' . $selected . '>' . $lang['name'] . '</option>';
        }
        $html_language .=
            '</select>
        </div>';


        $html_wrapper =
        '<div class="menu__wrapper">
            <div class="menu__wrapper__items">
                <ul>
                    '.$newItems.'
                </ul>
                '.$html_searchBar.'
            </div>
            <div class="menu__wrapper__custom">
                '.$html_customButton . $html_language.'
            </div>
        </div>';

        $items = $html_logo . $html_wrapper;
    }
    else if( $args->theme_location == 'footer-menu' ){
        // NEWSLETTER
        $newsletterTitle = get_field('newsletter_title', $menu);
        $newsletterLabel = get_field('newsletter_label', $menu);
        $newsletterButton = get_field('newsletter_button', $menu);

        $newsletterWrapper = 
        '<div class="newsletter">
            <p class="newsletter__title">'.$newsletterTitle.'</p>
            <input type="text" name="" id="newsletter_input" placeholder="'.$newsletterLabel.'">
            <a href="#" class="button outline icon">
                <p>'.$newsletterButton.'</p>
            </a>
        </div>';

        // MENU & SOCIAL MEDIA
        $extraPagesTitle = get_field('extra_title', $menu);
        $extraPagesRepeater = get_field('extra_pages_repeater', $menu);
        $socialRepeater = get_field('social_media_repeater', $menu);

        $itemsWrapper =
        '<div class="items">
            <ul class="items__menu">
                '.$items.'
            </ul>
            <div class="items__extra">
                <p class="items__extra__title">'.$extraPagesTitle.'</p>';
                foreach( $extraPagesRepeater as $extraPage ) {
                    $page = $extraPage['extra_page'];
                    foreach( $extraPage as $page ){
                        $permalink = get_permalink( $page->ID );
                        $title = get_the_title( $page->ID );
                        $itemsWrapper .= '<a href="'.$permalink.'" class="items__extra__page">'.$title.'</a>';
                    };
                };
            $itemsWrapper .=
            '</div>
            <div class="items__social">';
                foreach( $socialRepeater as $social ) {
                    $logo = $social['social_logo'];
                    $url = $social['social_url'];
                    $itemsWrapper .=
                    '<a href="'.$url.'" target="_blank"  class="items__social__logo">
                        <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
                    </a>';            
                };
        $itemsWrapper .=
        '   </div>
        </div>';

        // CONTACT
        $contactTitle = get_field('contact_title', $menu);
        $contactAddress = get_field('contact_address', $menu);
        $contactPhoneTitle = get_field('contact_phoneTitle', $menu);
        $contactPhone = get_field('contact_phone', $menu);
        $contactEmail = get_field('contact_email', $menu);
        $contactButton = get_field('contact_button', $menu);

        $contactWrapper =
        '<div class="contact">
            <p class="contact__title">'.$contactTitle.'</p>
            <p class="contact__address">'.$contactAddress.'</p>
            <a href="tel:'.$contactPhone.'" class="contact__tel">'.$contactPhoneTitle.'</a>
            <a href="mailto:'.$contactEmail.'" class="contact__email">'.$contactEmail.'</a>
            <a href="#" class="button outline icon">
                <p>'.$contactButton.'</p>
            </a>
        </div>';

        // LEGALS
        $logo = get_field('logoFooter_image', $menu);
        $leftLegal = get_field('left_legal', $menu);
        $rightLegal = get_field('right_legal', $menu);
        $firstPageTitle = get_field('first_page_title', $menu);
        $firstPageUrl = get_field('first_page', $menu);
        $secondPageTitle = get_field('second_page_title', $menu);
        $secondPageUrl = get_field('second_page', $menu);

        $legalWrapper =
        '<div class="legal">
            <div class="legal__logo">
                <a href="'.home_url().'">
                    <img src="'.$logo['url'].'" alt="'.$logo['alt'].'" />
                </a>
            </div>
            <div class="legal__text">
                <p>'.$leftLegal.'</p>
            </div>
            <div class="legal__wrapper">
                <p>'.$rightLegal.'</p>
                <a href="'.$firstPageUrl.'" target="_blank">'.$firstPageTitle.'</a>
                <a href="'.$secondPageUrl.'" target="_blank">'.$secondPageTitle.'</a>
            </div>
        </div>';

        $items = $newsletterWrapper . $itemsWrapper . $contactWrapper . $legalWrapper;
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

