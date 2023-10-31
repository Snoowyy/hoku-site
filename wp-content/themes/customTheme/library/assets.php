<?php 
/*:::::::::::::CSS y JS del tema:::::::::::::::::*/
function mainlinks()
{
    // Register styles:
	wp_register_style( 'main_style', get_template_directory_uri() . '/css/main.css');

	 // Register Scripts:
    // wp_register_script( 'main_jquery', get_template_directory_uri() . '/js/jquery.js');
	wp_register_script( 'mainscript', get_template_directory_uri() . '/js/mainscript.js' );

	// Add Styles ↓↓:
	wp_enqueue_style( 'main_style' );
	
	// Add Scripts ↓↓:
	wp_enqueue_script( 'main_jquery');
	wp_enqueue_script( 'mainscript' );
}
add_action( 'wp_enqueue_scripts', 'mainlinks', 5 );//el 5 es la prioridad para no tener conflictos con js genericos de wordpress

/*==========================================================================*/

?>