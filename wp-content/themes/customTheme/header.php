<div class="background-blur"></div>
<header class="header">
    <div class="header__content container">
        <?php echo wp_nav_menu(array( 'theme_location' => 'header-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
    </div>
    <div id="side-cart">
        <?php echo woocommerce_mini_cart(); ?>
    </div>
</header>