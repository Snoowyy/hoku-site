<?php
/*=================
Template Name: Product Listing
===================*/
get_header('wordpress');

$postId = get_the_ID();
$banner = get_field('banner', $postId);
$category = get_field('category', $postId);
$title = get_field('title', $postId);
$description = get_field('description', $postId);
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

// Obtiene todos los términos de la taxonomía del atributo
$color_filter = array(
    'taxonomy' => 'pa_color',
    'hide_empty' => true,
);
isset($_GET['color']) ? $color_filter['include'] = explode(',',$_GET['color']) : [];
$talla_filter = array(
    'taxonomy' => 'pa_talla',
    'hide_empty' => true,
);
isset($_GET['talla']) ? $talla_filter['include'] = explode(',',$_GET['talla']) : [];
$material_filter = array(
    'taxonomy' => 'pa_material',
    'hide_empty' => true,
);
isset($_GET['material']) ? $material_filter['include'] = explode(',',$_GET['material']) : [];
$color = get_terms( $color_filter );
$talla = get_terms( $talla_filter );
$material = get_terms( $material_filter );
?>
<section class="main-banner">
    <div class="main-swiper swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="swiper-slide__wrapper" style="
                    background-image: url('<?= $banner ?>');">
                    <div class="container">
                        <div class="swiper-slide__wrapper__image">
                            <img src="<?= $banner ?>" alt="">
                        </div>
                        <div class="swiper-slide__wrapper__texts-categories">
                            <p class="title"><?= $title ?></p>
                            <p class="description"><?= $description ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container products">
    <div class="products__filter">
        <button id="openModalBtn" class="products__filter__button">Filtros</button>
        <div class="products__filter__selects">
            <div class="accordion">
                <div class="accordion-item" data-index="1">
                    <div class="accordion-header">
                        Talla 
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_56_5166)">
                                <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="accordion-item" data-index="2">
                    <div class="accordion-header">
                        Color 
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_56_5166)">
                                <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="accordion-item" data-index="3">
                    <div class="accordion-header">
                        Material 
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_56_5166)">
                                <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="accordion-item" data-index="4">
                    <div class="accordion-header">
                        Precio 
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_56_5166)">
                                <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="accordion-item" data-index="5">
                    <div class="accordion-header">
                        Organizar por 
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_56_5166)">
                                <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-content" data-header="1">
            <?php foreach ($talla as $value) { ?>
                <button class="variation">
                    <?= $value->name ?>
                </button>
            <?php } ?>
        </div>
        <div class="accordion-content" data-header="2">
            <?php foreach ($color as $value) {
                $color_ = get_term_meta($value->term_id, 'product_attribute_color', true);
            ?>
                <button class="variation" style="background-color: <?= esc_attr($color_) ?>">
                </button>
            <?php } ?>
        </div>
        <div class="accordion-content" data-header="3">
            <?php foreach ($material as $value) { ?>
                <button class="variation">
                    <?= $value->name ?>
                </button>
            <?php } ?>
        </div>
        <div class="accordion-content" data-header="4">
            <?php foreach ($material as $value) { ?>
                <button class="variation">
                    <?= $value->name ?>
                </button>
            <?php } ?>
        </div>
        <div class="accordion-content" data-header="5">
            <div class="variation">
                Mayor a menor
            </div>
            <div class="variation">
                Menor a mayor
            </div>
        </div>
        <hr class="products__filter__selects__divider"></hr>
    </div>
    <div class="products__container">
        <?php foreach ($products as $product) { 
        $product_data = wc_get_product($product->ID);
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );
        ?>
            <a href="<?= $product_data->get_permalink(); ?>">
                <div class="products__container__product">
                    <img src="<?php echo $image[0]; ?>" alt="<?php echo esc_html( $product->post_title ); ?>">
                    <h6 class="title"><?= $product->post_title ?></h6>
                    <?php echo $product_data->get_price_html(); ?>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
<div id="filter_modal" class="modal">
            <div class="modal-content">
                <span class="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
                        <rect x="1.41431" width="35" height="2" transform="rotate(45 1.41431 0)" fill="#1D1D1D"/>
                        <rect width="35" height="2" transform="matrix(-0.707107 0.707107 0.707107 0.707107 24.7488 0)" fill="#1D1D1D"/>
                    </svg>
                </span>
                <div class="container">
                    <div class="accordion">
                        <div class="accordion-item">
                            <div class="accordion-header">
                                Talla 
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_56_5166)">
                                        <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="accordion-content">
                                <?php foreach ($talla as $value) { ?>
                                    <button class="variation">
                                        <?= $value->name ?>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="accordion__divider"></hr>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                Color 
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_56_5166)">
                                        <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="accordion-content">
                                <?php foreach ($color as $value) {
                                    $color_ = get_term_meta($value->term_id, 'product_attribute_color', true);
                                ?>
                                    <button class="variation" style="background-color: <?= esc_attr($color_) ?>">
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="accordion__divider"></hr>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                Material 
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_56_5166)">
                                        <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="accordion-content">
                                <?php foreach ($material as $value) { ?>
                                    <button class="variation">
                                        <?= $value->name ?>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="accordion__divider"></hr>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                Precio 
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_56_5166)">
                                        <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="accordion-content">
                                <?php foreach ($material as $value) { ?>
                                    <button class="variation">
                                        <?= $value->name ?>
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                        <hr class="accordion__divider"></hr>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                Organizar por 
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <mask id="mask0_56_5166" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="16" height="16">
                                        <rect width="16" height="16" transform="matrix(1.19249e-08 -1 -1 -1.19249e-08 16 16)" fill="#D9D9D9"/>
                                    </mask>
                                    <g mask="url(#mask0_56_5166)">
                                        <path d="M1.33329 5.33333L7.99996 12L14.6666 5.33333L13.4833 4.15L7.99996 9.63333L2.51663 4.15L1.33329 5.33333Z" fill="#1D1D1D"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="accordion-content">
                                <div class="variation">
                                    Mayor a menor
                                </div>
                                <div class="variation">
                                    Menor a mayor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var openModalBtn = document.getElementById("openModalBtn");
        var modal = document.getElementById("filter_modal");
        var closeModal = modal.querySelector(".close");

        openModalBtn.addEventListener("click", function () {
            modal.style.display = "block";
        });

        closeModal.addEventListener("click", function () {
            modal.style.display = "none";

        });

        window.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });

        var accordionItems = document.querySelectorAll(".accordion-item");
        let prevFilter;
        accordionItems.forEach(function (item) {
            var header = item.querySelector(".accordion-header");

            header.addEventListener("click", function () {
                var accordionItems = document.querySelectorAll(".accordion-content.active");
                accordionItems.forEach(function (active_item) {
                    active_item.classList.remove("active");
                })
                var accordionItems = document.querySelectorAll(".accordion-item.active");
                accordionItems.forEach(function (active_item) {
                    active_item.classList.remove("active");
                })
                item_content = document.querySelector(`[data-header="${item.dataset.index}"]`);
                if (item_content) {
                    if(item_content && item_content == prevFilter){
                        item_content.classList.remove("active");
                        item.classList.remove("active");
                        prevFilter = undefined;
                        return
                    }
                    item_content.classList.add("active");
                    prevFilter = item_content;
                } else {
                    if(item == prevFilter){
                        item.classList.remove("active");
                        prevFilter = undefined;
                        return
                    }
                    prevFilter = item;
                }
                item.classList.add("active");

            });
        });
    });
</script>
<?php do_shortcode("[bannerCategories]"); ?>
<?php do_shortcode("[featured_products]"); ?>
<?php do_shortcode("[bannerPride]"); ?>
<?php do_shortcode("[bannerHelp]"); ?>
<?php do_shortcode("[BannerNewsletter]"); ?>
<?php get_footer(); ?>