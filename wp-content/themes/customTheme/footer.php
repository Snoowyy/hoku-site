<footer class="footer">
    <div class="footer__content container">
        <div class="main">
            <?php echo wp_nav_menu(array( 'theme_location' => 'footer-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'legal-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'help-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
            <?php echo wp_nav_menu(array( 'theme_location' => 'social-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
        </div>
        <div class="foot">
            <?php echo wp_nav_menu(array( 'theme_location' => 'contact-menu', 'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',)); ?>
        </div>
    </div>
</footer>
<script>
    function redirectOnChange(selectElement) {
        var selectedValue = selectElement.value;

        if (selectedValue) {
            window.location.href = selectedValue;
        }
    }
</script>
<?php wp_footer() ?>