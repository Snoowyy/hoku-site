


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
});
  
