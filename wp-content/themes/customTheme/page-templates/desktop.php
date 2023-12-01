<?php
/*=================
Template Name: Login
===================*/
get_header('wordpress');
$postId = get_the_ID();
$banner = get_field('banner', $postId);

?>