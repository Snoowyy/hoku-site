<?php
/* START: Banner newsletter */
function banner_newsletter(){
    $newsletterTitle = get_field('newsletter_title', 'option');
    $newsletterDescription = get_field('newsletter_description', 'option');
    $newsletterInput = get_field('newsletter_input', 'option');
    $newsletterButton = get_field('newsletter_button', 'option');
    $newsletterImage = get_field('newsletter_image', 'option');

    $print = 
    '<section class="newsletter-section" style="
        background-image: url('.$newsletterImage['url'].');
        ">
        <div class="container">
            <div class="newsletter-section__wrapper">
                <p class="title">'.$newsletterTitle.'</p>
                <p class="description">'.$newsletterDescription.'</p>
                <input type="email" name="" id="" placeholder="'.$newsletterInput.'">
                <button type="button">'.$newsletterButton.'</button>
            </div>
            <div class="newsletter-section__image">
                <img src="'.$newsletterImage['url'].'" alt="'.$newsletterImage['alt'].'">
            </div>
        </div>
    </section>';

    wp_reset_postdata();
    echo $print;
}
add_shortcode('BannerNewsletter', 'banner_newsletter');

/* START: Banner help */
function banner_help(){
    $helpTitle = get_field('help_title', 'option');
    $helpDescription = get_field('help_description', 'option');
    $helpWhatIcon = get_field('help_whatsapp_icon', 'option');
    $helpWhat = get_field('help_whatsapp', 'option');
    $helpPhoneIcon = get_field('help_phone_icon', 'option');
    $helpPhoneLabel = get_field('help_phone_label', 'option');
    $helpPhoneNumber = get_field('help_phone_number', 'option');
    $helpEmailIcon = get_field('help_email_icon', 'option');
    $helpEmail = get_field('help_email', 'option');

    $print = 
    '<section class="help-section">
        <div class="container">
            <p class="title">'.$helpTitle.'</p>
            <p class="description">'.$helpDescription.'</p>
            <div class="help-section__wrapper">
                <div class="help-section__wrapper__icon">
                    <a href="'.$helpWhat.'" target="_blank" rel="noopener noreferrer">
                        <img src="'.$helpWhatIcon['url'].'" alt="'.$helpWhatIcon['alt'].'">
                        <p class="title">Whatsapp</p>
                    </a>
                </div>
                <div class="help-section__wrapper__icon">
                    <a href="tel:'.$helpPhoneNumber.'" target="_blank" rel="noopener noreferrer">
                        <img src="'.$helpPhoneIcon['url'].'" alt="'.$helpPhoneIcon['alt'].'">
                        <p class="title">Llamanos<br>'.$helpPhoneLabel.'</p>
                    </a>
                </div>
                <div class="help-section__wrapper__icon">
                    <a href="mailto:'.$helpEmail.'" target="_blank" rel="noopener noreferrer">
                        <img src="'.$helpEmailIcon['url'].'" alt="'.$helpEmailIcon['alt'].'">
                        <p class="title">'.$helpEmail.'</p>
                    </a>
                </div>
            </div>
        </div>
    </section>';

    wp_reset_postdata();
    echo $print;
}
add_shortcode('bannerHelp', 'banner_help');

/* START: Banner pride */
function banner_pride(){
    $prideTitle = get_field('pride_title', 'option');
    $prideDescription = get_field('pride_description', 'option');
    $prideSlider = get_field('pride_slider', 'option');
    $prideTexts = get_field('pride_texts', 'option');

    $print = 
    '<section class="pride-section">
        <div class="container">
            <p class="title">'.$prideTitle.'</p>
            <p class="description">'.$prideDescription.'</p>
            <div class="pride-swiper">
                <div class="swiper-wrapper">';
                foreach( $prideSlider as $slide ) {
                    $image = $slide['slider_pride_image'];
                    $print .= 
                    '<div class="swiper-slide">
                        <img src="'.$image['url'].'" alt="'.$image['alt'].'">
                    </div>';          
                };
                $print .=
                '</div>
            </div>
            <div class="pride-section__wrapper">';
            foreach( $prideTexts as $text ) {
                $title = $text['pride_texts_title'];
                $description = $text['pride_texts_description'];
                $print .= 
                '<div class="pride-section__wrapper__item">
                    <p class="title">'.$title.'</p>
                    <p class="description">'.$description.'</p>
                </div>';          
            };
            $print .=
            '</div>
        </div>
    </section>';

    wp_reset_postdata();
    echo $print;
}
add_shortcode('bannerPride', 'banner_pride');
?>