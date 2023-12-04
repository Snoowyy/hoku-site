<?php
/*=================
Template Name: Desktop
===================*/
get_header('wordpress');
$postId = get_the_ID();
$description = get_field('description', $postId);
$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<div class="container">
    <div class="desktop">
        <div class="desktop__navigation">
            <h3>MI CUENTA</h3>
            <select id="navigation">
                <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                    <option>
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="desktop__dashboard">
            <h4>
                <?= get_the_title($postId) ?>
            </h4>
            <div class="desktop__dashboard__description">
                <p>
                    <?php
                        printf(
                            /* translators: 1: user display name 2: logout url */
                            wp_kses( __( 'Hola <b>%1$s</b> (¿No eres <b>%1$s</b>? <a href="%2$s">Cerrar sesión</a>)', 'woocommerce' ), $allowed_html ),
                            '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                            esc_url( wc_logout_url() )
                        );
                    ?>
                </p>
                <p><?= $description ?></p>
            </div>
        </div>
    </div>
</div>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php do_action( 'woocommerce_auth_page_footer' ); ?>

<style>
    .header .menu__logo,
    .header .menu__icons #user_icon img,
    .header .menu__icons #search_icon svg,
    .header .menu__icons #cart_icon img{
        filter: brightness(0);
    }
    .header.open .menu__icons,
    .header.scrolled .menu__logo,
    .header.scrolled .menu__icons {
        filter: unset;
    }
    .header:not(.scrolled) .header__content .menu__wrapper__items .menu-item a{
        color: var(--main-gray-dark, #1D1D1D);
    }
</style>
<script>
    var dynamic = document.getElementById('navigation');
    dynamic.setAttribute('size', dynamic.childElementCount)
</script>
<?php get_footer(); ?>