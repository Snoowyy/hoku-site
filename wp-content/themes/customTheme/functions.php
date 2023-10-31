<?php 
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
/** colores de status de post - Soporte de thumbnails y carpetas tambn deshabilita barra de admin wordpress */
require_once( 'library/basicos.php' );

/** Menus y Widgets y breadcums*/
require_once( 'library/generales.php' );

/** libreria de estilos y scripts */
require_once( 'library/assets.php' );

/** modificador del editor de texto WYSIWYG */
require_once( 'library/wysiwyg.php' );

/** Pagina de opciones ACF */
require_once( 'library/acf-options.php' );

/** Pagina de opciones ACF */
require_once( 'library/utilities.php' );

/** Pagina de shortcodes */
require_once( 'library/shortcodes.php' );

/** Pagina de opciones ACF */
?>