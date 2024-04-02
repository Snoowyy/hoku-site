window.onload = function () {
    setTimeout(() => {
        const singleAddButton = document.querySelector(".single_add_to_cart_button");
        if (singleAddButton) {
            singleAddButton.innerHTML = "ADD TO QUOTE";
            singleAddButton.addEventListener('click', () => {
                document.querySelector('.lakit-cart').classList.add('lakit-cart-open');
            })
        }

        const quoteQuantity = document.querySelector("th.product-quantity");
        if (quoteQuantity) {
            const span = document.createElement("span");
            span.className = "yards";
            span.textContent = " (yards)";
            quoteQuantity.appendChild(span);
        }

        const inputWithoutEnter = document.querySelector(".lakit-search__field");
        inputWithoutEnter.addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        const viewQuoteButtons = document.querySelectorAll(
            ".wc-forward:not(.checkout)"
        );
        if (viewQuoteButtons.length > 0) {
            viewQuoteButtons.forEach((element) => {
                element.innerHTML = "VIEW QUOTE";
            });
        }

        const buttonsContainer = document.querySelector(".woocommerce-mini-cart__buttons.buttons");

        let continueButton  = document.createElement("a");
        let viewQuoteButton  = document.createElement("a");
      
        if(buttonsContainer){
            continueButton.textContent = "CONTINUE EXPLORING";
            anchorElement2.classList.add("lakit-cart__close-button", "clase-2", "clase-3");
            buttonsContainer.appendChild(continueButton);
        }

        const BlankPrimarySet = document.querySelector(".fabric-primary-button");
        if (BlankPrimarySet) {
            BlankPrimarySet.setAttribute('target', '_blank');
        }
        const BlankSecondarySet = document.querySelector(".fabric-secondary-button");
        if (BlankSecondarySet) {
            BlankSecondarySet.setAttribute('target', '_blank');
        }

        const html = document.querySelector("html");
        const hideOverflow = document.querySelector(".zoomouter");
        let showOverflow;

        if (hideOverflow) {
            hideOverflow.addEventListener("click", function () {
                html.style.overflow = "hidden";
                setTimeout(() => {
                    showOverflow = document.querySelector(".dialog-close-button");
                    showOverflow.addEventListener("click", function () {
                        html.style.overflow = "auto";
                    });
                }, 1000);
            });
        }

        let formQuoteContainer = document.querySelector("#quote-form form");
        let buttonSubmitQuote = document.querySelector("#submit_for_a_quote");
        let parentSubmitButton = document.querySelector("#submit_quote");
        if (formQuoteContainer) {
            const validatorQuote = new JustValidate("#quote-form form", {
                validateBeforeSubmitting: true,
            }).onValidate(function ({ isValid, isSubmitted, fields, groups }) {
                if (isValid) {
                    buttonSubmitQuote.style.opacity = "1";
                    parentSubmitButton.style.pointerEvents = "all";
                } else {
                    buttonSubmitQuote.style.opacity = "0.5";
                    parentSubmitButton.style.pointerEvents = "none";
                }
            });
            validatorQuote
                .addField("#billing_first_name", [
                    {
                        rule: "required",
                        errorMessage: "The name is required",
                    },
                    {
                        rule: "minLength",
                        value: 3,
                        errorMessage: "The name must be at least 3 characters long",
                    },
                    {
                        rule: "customRegexp",
                        value: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]*$/,
                        errorMessage: "Enter a valid name",
                    },
                ])
                .addField("#billing_company", [
                    {
                        rule: "required",
                        errorMessage: "Field required",
                    },
                ])
                .addField("#billing_phone", [
                    {
                        rule: "required",
                        errorMessage: "The phone number is required",
                    },
                    {
                        rule: "number",
                        errorMessage: "The phone number must be numeric",
                    },
                    {
                        rule: "minLength",
                        value: 7,
                        errorMessage: "Enter a valid phone number",
                    },
                ])
                .addField("#billing_email", [
                    {
                        rule: "required",
                        errorMessage: "The email is required",
                    },
                    {
                        rule: "email",
                        errorMessage: "Enter a valid email",
                    },
                ]);

            buttonSubmitQuote.addEventListener("click", (e) => {
                if (validatorQuote.isFormValid()) {
                    e.preventDefault();
                    document.querySelector("#place_order").click();
                }
            });
        }
        let formContact = document.querySelector("#form-contact form");
        let sendMessageButton = document.querySelector(".wpcf7-submit");
        let sendMessageButtonParent = document.querySelector(".lakit-col.submit-container");
        if(formContact){
            sendMessageButton.disabled = true;
            const validatorFormContact = new JustValidate("#form-contact form", {
                validateBeforeSubmitting: true,
            }).onValidate(function ({ isValid, isSubmitted, fields, groups }) {
                if (isValid) {
                    sendMessageButton.disabled = false;
                    sendMessageButtonParent.style.opacity = "1";
                } else {
                    sendMessageButtonParent.style.opacity = "0.5";
                }
            });
            validatorFormContact
                .addField(document.querySelector('input[name="first-name"]'), [
                    {
                        rule: "required",
                        errorMessage: "The name is required",
                    },
                    {
                        rule: "minLength",
                        value: 3,
                        errorMessage: "The name must be at least 3 characters long",
                    },
                    {
                        rule: "customRegexp",
                        value: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]*$/,
                        errorMessage: "Enter a valid name",
                    },
                ])
                .addField(document.querySelector('input[name="last-name"]'), [
                    {
                        rule: "required",
                        errorMessage: "The name is required",
                    },
                    {
                        rule: "minLength",
                        value: 3,
                        errorMessage: "The name must be at least 3 characters long",
                    },
                    {
                        rule: "customRegexp",
                        value: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]*$/,
                        errorMessage: "Enter a valid name",
                    },
                ])
                .addField(document.querySelector('input[name="your-company"]'), [
                    {
                        rule: "required",
                        errorMessage: "The name is required",
                    },
                    {
                        rule: "minLength",
                        value: 3,
                        errorMessage: "The name must be at least 3 characters long",
                    },
                    {
                        rule: "customRegexp",
                        value: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]*$/,
                        errorMessage: "Enter a valid name",
                    },
                ])
                .addField(document.querySelector('input[name="phone"]'), [
                    {
                        rule: "required",
                        errorMessage: "The phone number is required",
                    },
                    {
                        rule: "number",
                        errorMessage: "The phone number must be numeric",
                    },
                    {
                        rule: "minLength",
                        value: 7,
                        errorMessage: "Enter a valid phone number",
                    },
                ])
                .addField(document.querySelector('input[name="your-email"]'), [
                    {
                        rule: "required",
                        errorMessage: "The email is required",
                    },
                    {
                        rule: "email",
                        errorMessage: "Enter a valid email",
                    },
                ]);
        }
    }, 500);

    setTimeout(() => {
        document.querySelector(".loader-container").classList.add("page-loaded");

        let observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                let oldValue = mutation.oldValue;
                let newValue = mutation.target.textContent;
                if (oldValue !== newValue) {
                    if(checkUrlPattern(window.location.pathname)){
                        addPagination();
                    }
                }
            });
        });
        
        const checkUrlPattern = (path) =>{
            const regex = /^\/product-category\/.+/;
            const isProductCategory = regex.test(path);
        
            if (isProductCategory) {
                return true;
            }else{
                return false;
            }
        }
        
        function addPagination() {
            const resultCountElement = document.querySelector('.woocommerce-result-count');
        
            if (resultCountElement) {
                const text = resultCountElement.textContent;
                const regex = /Showing \d+–\d+ of (\d+) results/; // Esta expresión regular no debe cambiarse
                const matches = text.match(regex);
        
                if (matches) {
                    const totalResults = parseInt(matches[1], 10);
                    const pages = Math.ceil(totalResults / 12);
                    const currentPage = parseInt(window.location.pathname.match(/page\/(\d+)/)?.[1] || 1);
                    const paginationContainer = document.querySelector('.lakit-pagination .page-numbers');
        
                    if (paginationContainer) {
                        while (paginationContainer.firstChild) {
                            paginationContainer.removeChild(paginationContainer.firstChild);
                        }
        
                        const updatePageUrl = (pageNumber) => {
                            const baseUrl = window.location.href.replace(/page\/\d+\/?$/, '');
                            window.location.href = `${baseUrl}page/${pageNumber}`;
                        };
        
                        if (currentPage > 1) {
                            const prevPageItem = document.createElement('li');
                            prevPageItem.innerHTML = `<a class="prev page-numbers" href="#" >←</a>`;
                            prevPageItem.addEventListener('click', (e) => {
                                e.preventDefault();
                                updatePageUrl(currentPage - 1);
                            })
                            paginationContainer.appendChild(prevPageItem);
                        }
        
                        for (let i = 1; i <= pages; i++) {
                            const pageItem = document.createElement('li');
                            if (i === currentPage) {
                                pageItem.innerHTML = `<span aria-current="page" class="page-numbers current">${i}</span>`;
                            } else {
                                pageItem.innerHTML = `<a class="page-numbers" href="#">${i}</a>`;
                                pageItem.addEventListener('click', (e) => {
                                    e.preventDefault();
                                    updatePageUrl(i);
                                })
                            }
                            paginationContainer.appendChild(pageItem);
                        }
        
                        if (currentPage < pages) {
                            const nextPageItem = document.createElement('li');
                            nextPageItem.innerHTML = `<a class="next page-numbers" href="#">→</a>`;
                            nextPageItem.addEventListener('click', (e) => {
                                e.preventDefault();
                                updatePageUrl(currentPage + 1);
                            })
                            paginationContainer.appendChild(nextPageItem);
                        }
                    }
                } else {
                    const paginationContainer = document.querySelector('.lakit-pagination .page-numbers');
        
                    if (paginationContainer) {
                        while (paginationContainer.firstChild) {
                            paginationContainer.removeChild(paginationContainer.firstChild);
                        }
        
                        const onlyPageItem = document.createElement('li');
                        onlyPageItem.innerHTML = `<span aria-current="page" class="page-numbers current">1</span>`;
                        paginationContainer.appendChild(onlyPageItem);
                    }
                }
            }
        }
        
        let page_counter = document.querySelector('#showin_results_label');
        if(page_counter){
            observer.observe(page_counter, {
                characterDataOldValue: true,
                subtree: true,
                childList: true,
                characterData: true
            });
        }

        if(checkUrlPattern(window.location.pathname)){
            addPagination();
        }
    }, 600);
};

document.addEventListener("DOMContentLoaded", (event) => {
    setTimeout(() => {
        for (let starIndex = 0; starIndex < 5; starIndex++) {
            let starElement = document.querySelector(`.star-${starIndex + 1}`);
            if (starElement) {
                starElement.addEventListener("mouseover", () => {
                    setStar(starIndex + 1);
                });
                starElement.addEventListener("mouseout", () => {
                    cleanStar();
                });
            }
        }
    }, 500);
});

function setStar(id) {
    for (let starIndex = 0; starIndex < id; starIndex++) {
        document.querySelector(`.star-${starIndex + 1}`).classList.add("hovered");
    }
}

function cleanStar() {
    for (let starIndex = 0; starIndex < 5; starIndex++) {
        document
            .querySelector(`.star-${starIndex + 1}`)
            .classList.remove("hovered");
    }
}