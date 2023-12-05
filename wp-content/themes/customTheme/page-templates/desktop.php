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
        <h3>MI CUENTA</h3>
        <div class="desktop__container">
            <div class="desktop__navigation">
                <select onchange="redirectOnChange(this)">
                    <option value="/desktop">Escritorio</option>
                    <option value="/orders">Pedidos</option>
                    <option value="/address">Dirección</option>
                    <option value="/account">Detalles de la cuenta</option>
                    <option value="/desktop">Salir</option>
                </select>
                <div class="desktop__navigation__wrapper">
                    <a href="/desktop" class="active">Escritorio</a>
                    <a href="/orders">Pedidos</a>
                    <a href="/address">Dirección</a>
                    <a href="/account">Detalles de la cuenta</a>
                    <a href="/desktop">Salir</a>
                </div>
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
<?php get_footer(); ?>