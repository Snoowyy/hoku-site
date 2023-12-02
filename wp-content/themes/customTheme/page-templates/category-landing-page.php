<?php
/*=================
Template Name: CLP
===================*/
get_header('wordpress');

$postId = get_the_ID();
$header = get_field('header', $postId);
$category = get_field('category', $postId);
$first_section = get_field('first_section', $postId);
$second_section = get_field('second_section', $postId);
// Configura los parámetros de la consulta
$args = array(
    'post_type'      => 'product', // Tipo de publicación: 'product' para productos de WooCommerce
    'posts_per_page' => -1, // -1 para obtener todos los productos, puedes ajustar esto según tus necesidades
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat', // Taxonomía para las categorías de productos en WooCommerce
            'field'    => 'id',
            'terms'    => $category, // ID de la categoría
        ),
    ),
);
// Realiza la consulta
$products = get_posts($args);
$firts_products = array_slice($products, 0, 2);
$seconds_products = array_slice($products, 2, 2);
$thirds_products = array_slice($products, 4, 2);
?>
<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('<?= $header['banner'] ?>');">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="<?= $header['banner'] ?>" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts-categories">
                            <h1 class="title"><?= $header['title'] ?></h1>
                            <p class="description"><?= $header['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="product-container">
        <?php foreach ($firts_products as $product) { 
        $product_data = wc_get_product($product->ID);
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
        ?>
            <a href="<?= $product_data->get_permalink(); ?>">
                <div class="product-container__product">
                    <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $product->post_title ); ?>">
                    <h6 class="title"><?= $product->post_title ?></h6>
                    <?php echo $product_data->get_price_html(); ?>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="category-info">
        <div class="category-info__image">
            <div class="category-info__image--filter">
                <img src="<?php echo $first_section['image']; ?>" alt="<?php echo $info_image['alt']; ?>">
            </div>
            <img src="<?php echo $first_section['image']; ?>" alt="<?php echo $info_image['alt']; ?>">
            <div class="category-info__detail">
                <h2 class="category-info__detail__title"><?= $first_section['title'] ?></h2>
                <p class="category-info__detail__description"><?= $first_section['description'] ?></p>
            </div>
        </div>
    </div>
    <div class="product-container">
        <?php foreach ($seconds_products as $product) { 
        $product_data = wc_get_product($product->ID);
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
        ?>
            <a href="<?= $product_data->get_permalink(); ?>">
                <div class="product-container__product">
                    <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $product->post_title ); ?>">
                    <h6 class="title"><?= $product->post_title ?></h6>
                    <?php echo $product_data->get_price_html(); ?>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="category-info-secondary">
        <div class="category-info-secondary__image">
            <img src="<?= $second_section['image'] ?>">
        </div>
        <div class="category-info-secondary__detail">
            <h1 class="category-info-secondary__detail__title"><?= $second_section['title']; ?></h1>
            <p class="category-info-secondary__detail__description"><?= $second_section['description']; ?></p>
        </div>
    </div>
    <div class="product-container">
        <?php foreach ($thirds_products as $product) { 
        $product_data = wc_get_product($product->ID);
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
        ?>
            <a href="<?= $product_data->get_permalink(); ?>">
                <div class="product-container__product">
                    <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $product->post_title ); ?>">
                    <h6 class="title"><?= $product->post_title ?></h6>
                    <?php echo $product_data->get_price_html(); ?>
                </div>
            </a>
        <?php } ?>
    </div>
    <div class="show_all">
        <a href="/tienda-hombre" class="show_all__button">Ver todos los productos</a>

    </div>
</div>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>