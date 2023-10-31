<?php
/*==================
 archivo de postype
 productos
 ===================*/
get_header('wordpress'); ?>

	<div id="container">
		<p>contenido productos</p>
		
		<?php get_template_part( 'template-parts/content', 'producto' ); ?>

		<p>inicio de sidebar</p>
		<?php get_sidebar(); ?>
		
	</div><!-- fin container -->


<?php get_footer(); ?>