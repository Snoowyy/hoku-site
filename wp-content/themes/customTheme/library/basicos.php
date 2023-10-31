<?php 
/*Funciones CavDragon Template*/
/*========soporte de thumbnails=========================*/
add_theme_support('post-thumbnails');
/*==========Soporte de carpetas==========================*/
define('TEMPPATH', get_bloginfo('stylesheet_directory'));
define('IMAGES', TEMPPATH.'/img');
/*se pueden llamar imagenes en el thema usando: 
    <?php print IMAGES;?>/image.jpg  -*/
/*===================================*/

/*==========================================================================*/
/*----Deshabilitar barra de admin wordpress---------------------*/
show_admin_bar(false);
/*----------------------------------------------------------------------------*/

?>