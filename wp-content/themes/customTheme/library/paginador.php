<?php
function createCustomTagPaginator() {
	ob_start();
	?>
		<div class="pages clearfix">
			<?php
				$pagination = paginate_links( array(
					'type' => 'array',
					'prev_text' => '',
					'next_text' => ''
				) ); ?>
			<?php if ( ! empty( $pagination ) ) : ?>
				<ul class="paginacion__container">
					<?php foreach ( $pagination as $key => $page_link ) : ?>
						<li class="paginacion__number<?php if ( strpos( $page_link, 'current' ) !== false ) { echo ' paginacion__number--active'; } ?>">
                            <?php echo $page_link ?>
                        </li>
					<?php endforeach ?>
				</ul>
			<?php endif ?>
		</div>
	<?php
}
function printCustomTagPaginator() {
	echo createCustomTagPaginator();
}
?>
