<?php
/*==================
 themplate para mostrar 
 paginas por default
 ===================*/
get_header('wordpress'); ?>

    <?php get_template_part( 'template-parts/content', 'page' ); ?>

    <p>inicio de sidebar</p>
    <?php get_sidebar(); ?>

<?php get_footer(); ?>