<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php bloginfo( 'name' );  wp_title(); ?></title>
    
    <meta name="generator" content="CD <?php bloginfo( 'version' ); ?>" />
    <meta name="description" content="<?php bloginfo( 'description' ); ?>" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
    <!--styles-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css">

    <?php wp_head(); ?>
</head>

<body  class='<?= is_front_page() ? 'home': '' ?>' >
    <?php get_header(); ?>
   