document.addEventListener("DOMContentLoaded", function () {
    
    let lastScrollTop = 0;
    const header = document.querySelector(".header");
    const hamburguer = document.querySelector(".hamburguer");
    
    //Control header scroll
    window.addEventListener("scroll", function() {
      let scrollTop = window.scrollY || document.documentElement.scrollTop;
      
      if (scrollTop > lastScrollTop) {
        header.classList.add('scrolled');
      } else if(scrollTop == 0) {
        // Cuando se hace scroll hacia arriba
        header.classList.remove('scrolled');
      }
    
      lastScrollTop = scrollTop;
    });

    //Control hamburguer menu
    hamburguer.addEventListener("click", function() {
        header.classList.toggle('open');
    });

    //Control footer

    const footerItems = document.querySelectorAll('.menu__wrapper__items .title');
    footerItems.forEach(element => {
        element.addEventListener('click', () => {
            element.parentElement.classList.toggle('active');
        })
    });

    //Control Home Banner

    const mainSwiper = new Swiper('.main-swiper', {
        speed: 500,
        loop: true,
        followFinger: true,
        grabCursor: true,
        navigation: {
            nextEl: '#main_banner_slider_next',
            prevEl: '#main_banner_slider_prev',
        },
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
        },
    });

    //Control scrollbar counter

    const mainSlides = document.querySelectorAll('.main-banner .swiper-slide');
    if(document.getElementById('max_slides')){
        document.getElementById('max_slides').innerHTML = '0' + mainSlides.length;
    }

    //Control Pride Slider

    const prideSwiper = new Swiper('.pride-swiper', {
        speed: 500,
        followFinger: true,
        grabCursor: true,
        slidesPerView: 1.2,
        // spaceBetween: 10,
        // Responsive breakpoints
        breakpoints: {
            768: {
                slidesPerView: 2.2,
            },
            1200: {
                slidesPerView: 4,
            }
        }
    });

    //Control Product slider

    const productSwiper = new Swiper('.featured_section__slider', {
        speed: 500,
        followFinger: true,
        grabCursor: true,
        slidesPerView: 1.4,
        spaceBetween: 28,
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true,
        },
        breakpoints: {
            1440: {
                slidesPerView: 3,
            }
        }
    });

    // Control color picker style
    let colorPicker = document.querySelectorAll('.variable-item-span-color');
    if(colorPicker){
        colorPicker.forEach(element => {
            let style = window.getComputedStyle(element);
            let colorFondo = style.getPropertyValue('background-color');
            element.parentElement.parentElement.style.borderColor = colorFondo;
        });
    }

    // Control product card tabs
    let productTabs = document.querySelectorAll('.tab__title');
    if(productTabs){
        productTabs.forEach(element => {
            element.addEventListener('click', () => {
                element.parentElement.classList.toggle('active');
            })
        });
    }

    // Control Story Slider
    const storySwiper = new Swiper('.story__slider', {
        speed: 500,
        followFinger: true,
        grabCursor: true,
        slidesPerView: 1.1,
        spaceBetween: 20,
        // breakpoints: {
        //     1440: {
        //         slidesPerView: 3,
        //     }
        // }
    });

    // Control Update Quantity
    let timeout;
    let quantityInputs = document.querySelectorAll('button.qib-button');

    quantityInputs.forEach(function(input) {
        input.addEventListener('click', function() {
            updateCart();
        });
    });

    function updateCart(){
        if (timeout) {
            clearTimeout(timeout);
        }
        timeout = setTimeout(function() {
            // Comprobar si el botón de actualización del carrito existe antes de hacer clic
            let updateCartButton = document.querySelector("[name='update_cart']");
            if (updateCartButton) {
                updateCartButton.disabled = false;
                updateCartButton.click();
            } else {
                console.error('El botón de actualización del carrito no se encontró.');
            }
        }, 500);
    }

    // Control Coupon

    let coupon = document.querySelector('.coupon__wrapper');
    if(coupon){
        coupon.querySelector('.coupon__wrapper__title').addEventListener('click', () => {
            coupon.classList.toggle('active');
        })
    }

    // Control Remove Coupon

    let removeCoupon = document.querySelector('.woocommerce-remove-coupon');

    if(removeCoupon){
        removeCoupon.addEventListener('click', () => {
            updateCart();
        })
    }

    // Control Interest Slider
    
    const interestSwiper = new Swiper('.interest-swiper', {
        speed: 500,
        followFinger: true,
        grabCursor: true,
        slidesPerView: 1.4,
        spaceBetween: 28,
        breakpoints: {
            1199: {
                slidesPerView: 3,
            }
        }
    });

    // Control Shipping Info

    // Expande siempre la sección de dirección de envío
    let shippingCheckbox = document.getElementById('ship-to-different-address-checkbox');
    if (shippingCheckbox) {
        shippingCheckbox.checked = true;
        document.querySelector('.shipping_address').style.display = 'block';

        // Opcional: Oculta el checkbox ya que no es necesario
        let shippingLabel = document.querySelector('#ship-to-different-address');
        if (shippingLabel) {
            shippingLabel.style.display = 'none';
        }
    }

    // Control checkbox states
    let checkBoxes = document.querySelectorAll('input[type="checkbox"]');

    if(checkBoxes){
        checkBoxes.forEach(element => {
            element.addEventListener('click', () => {
                element.parentElement.classList.toggle('checked');
            })
        });
    }

    // Control Placeholders
    setTimeout(() => {
        if(document.getElementById('shipping_address_1')){
            document.getElementById('shipping_address_1').placeholder = '*Ingrese su dirección';
            document.getElementById('shipping_address_2').placeholder = 'Casa, apartamento, etc (Opcional)';
        }
    }, 100);

    // Control Checkout Newsletter
    let checkNewslet = document.querySelector('#shipping_newsletter');
    if(checkNewslet){
        checkNewslet.addEventListener('click', () => {
            document.querySelector('#mailpoet_woocommerce_checkout_optin').checked = checkNewslet.checked;
            console.log('AJUA' + document.querySelector('#mailpoet_woocommerce_checkout_optin').checked);
        })
    }

    // Control SearchBar Button
    let searchButton = document.querySelectorAll('.dgwt-wcas-search-submit');
    let pElement = document.createElement('p');
    pElement.textContent = 'Buscar';

    
    searchButton.forEach(element => {
        element.appendChild(pElement);
    });

    // Control Checkout
    const fistStep = document.querySelector('.woocommerce-billing-fields__field-wrapper');
    const firstInputs = document.querySelectorAll('.woocommerce-billing-fields__field-wrapper .wooccm-required-field');
    const firstButton = document.getElementById('next_step');

    const secondStep = document.querySelector('.woocommerce-shipping-fields__field-wrapper');
    const secondInputs = document.querySelectorAll('.woocommerce-shipping-fields__field-wrapper .wooccm-required-field:not(#shipping_state)');
    const secondButton = document.getElementById('final_step');

    const thirdStep = document.querySelector('.woocommerce-checkout-review-order');

    const checkInputs = () => {
        let allFilled = true;
        firstInputs.forEach(input => {
            if (input.value.trim() === '') {
                allFilled = false;
            }
        });
        firstButton.disabled = !allFilled;
    };

    firstInputs.forEach(input => {
        input.addEventListener('input', checkInputs);
    });

    if(document.querySelector('#shipping_state_field')){
        document.querySelector('#shipping_state_field').addEventListener('click', () => {
            document.querySelector('.select2-results__options').addEventListener('click', checkInputs);
        });
    }

    if(firstButton){
        firstButton.addEventListener('click', () => {
            fistStep.classList.remove('active');
            secondStep.classList.add('active');
            fistStep.parentElement.classList.add('editable');
        })
    }

    const checkSecondInputs = () => {
        let allFilled = true;
        secondInputs.forEach(input => {
            if (input.value.trim() === '' || !document.querySelector('.woocommerce-shipping-fields__field-wrapper #shipping_state').value.trim()) {
                allFilled = false;
            }
        });
        secondButton.disabled = !allFilled;
    };
    
    if(secondInputs){
        secondInputs.forEach(input => {
            input.addEventListener('input', checkSecondInputs);
        });
    }

    if(secondButton){
        secondButton.addEventListener('click', () => {
            secondStep.classList.remove('active');
            thirdStep.classList.add('active');
            console.log(thirdStep);
            secondStep.parentElement.classList.add('editable');
        })
    }

    //Control Header message gap

    let headerElement = document.querySelector('header.header');
    let headerMessage = document.querySelector('.header .menu__message');

    if(headerMessage){
        const headerSectionGap = document.createElement("section");
        headerSectionGap.classList.add('header-message-gap');
        headerElement.parentNode.insertBefore(headerSectionGap, headerElement.nextSibling);
    }

});

