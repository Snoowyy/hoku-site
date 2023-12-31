<?php
/*=================
Template Name: Login
===================*/
get_header('wordpress');
$postId = get_the_ID();
$banner = get_field('banner', $postId);

?>
<div class="login">
    <div class="login__image">
        <div class="login__image--filter">
            <img src="<?= $banner ?>" alt="<?php echo $info_image['alt']; ?>">
        </div>
        <img src="<?= $banner ?>" alt="<?php echo $info_image['alt']; ?>">
    </div>
    <form method="post" class="container login__form_container">
        <h4>Iniciar sesión</h4>
        <p class="login__form_container__input">
            <input placeholder="Correo electrónico * " type="text" name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''; ?>" /><?php //@codingStandardsIgnoreLine ?>
        </p>
        <p class="login__form_container__input">
            <input placeholder="Contraseña" type="password" name="password" id="password" />
        </p>
        <p class="form__send login__form_container__button">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <button type="submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Continuar', 'woocommerce' ); ?></button>
            <input type="hidden" name="redirect" value="<?php echo esc_url( '/desktop' ); ?>" />
        </p>
        <input name="rememberme" type="checkbox" id="rememberme" value="forever" <?php checked( $rememberme ); ?> />
        <label for="rememberme"><?php esc_html_e( 'Recordar mis datos' ); ?></label>
        <a class="login__form_container__remember"><b>Recordar contraseña</b></a>
        <hr class="login__divider"></hr>
        <div class="login__register_container">
            <h4>¿No tienes cuenta?</h4>
            <p>
                Únete a nuestra comunidad de amantes del calzado. Regístrate para acceder a ofertas exclusivas y mantenerte al tanto de las últimas tendencias. ¡Únete hoy!
            </p>
            <a class="button_white">Registrarse</a>
        </div>
    </form>
</div>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php do_action( 'woocommerce_auth_page_footer' ); ?>
<style>
    .header .menu__logo,
    .header .menu__icons #user_icon img,
    .header .menu__icons #search_icon svg,
    .header .menu__icons #cart_icon img,
    .header .menu__icons .hamburguer{
        filter: brightness(0);
    }
    .header.open .menu__icons,
    .header.scrolled .menu__logo,
    .header.scrolled .menu__icons #user_icon img,
    .header.scrolled .menu__icons #search_icon svg,
    .header.scrolled .menu__icons #cart_icon img,
    .header.scrolled .menu__icons .hamburguer{
        filter: unset;
    }
    .header:not(.scrolled) .header__content .menu__wrapper__items .menu-item a{
        color: var(--main-gray-dark, #1D1D1D);
    }
</style>
<?php get_footer(); ?>
