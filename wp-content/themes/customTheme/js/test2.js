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
    // Encuentra el elemento por su clase
    const resultCountElement = document.querySelector('.woocommerce-result-count');

    // Verifica si el elemento existe y tiene contenido
    if (resultCountElement) {
        const text = resultCountElement.textContent;
        const regex = /Showing \d+–\d+ of (\d+) results/; // Esta expresión regular no debe cambiarse
        const matches = text.match(regex);

        if (matches) {
            // Extrae el total de resultados y lo convierte a número
            const totalResults = parseInt(matches[1], 10);

            // Divide el total de resultados por 12 y redondea hacia arriba para obtener el número total de páginas
            const pages = Math.ceil(totalResults / 12);

            // Detecta la página actual basada en la URL
            const currentPage = parseInt(window.location.pathname.match(/page\/(\d+)/)?.[1] || 1);

            // Encuentra el contenedor de los números de página
            const paginationContainer = document.querySelector('.lakit-pagination .page-numbers');

            if (paginationContainer) {
                // Primero, elimina todos los elementos li existentes
                while (paginationContainer.firstChild) {
                    paginationContainer.removeChild(paginationContainer.firstChild);
                }

                // Función para actualizar la URL correctamente
                const updatePageUrl = (pageNumber) => {
                    const baseUrl = window.location.href.replace(/page\/\d+\/?$/, '');
                    window.location.href = `${baseUrl}page/${pageNumber}`;
                };

                // Añade el botón de página anterior si no estás en la primera página
                if (currentPage > 1) {
                    const prevPageItem = document.createElement('li');
                    prevPageItem.innerHTML = `<a class="prev page-numbers" href="#" >←</a>`;
                    prevPageItem.addEventListener('click', (e) => {
                        e.preventDefault();
                        updatePageUrl(currentPage - 1);
                    })
                    paginationContainer.appendChild(prevPageItem);
                }

                // Añade las páginas
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

                // Añade el botón de página siguiente solo si no estás en la última página
                if (currentPage < pages) {
                    const nextPageItem = document.createElement('li');
                    nextPageItem.innerHTML = `<a class="next page-numbers" href="#">→</a>`;
                    nextPageItem.addEventListener('click', (e) => {
                        e.preventDefault();
                        updatePageUrl(currentPage + 1);
                    })
                    paginationContainer.appendChild(nextPageItem);
                }

            } else {
                console.log('El contenedor de paginación no fue encontrado.');
            }
        } else {
            console.log('El texto no sigue el formato esperado.');
        }
    } else {
        console.log('Elemento .woocommerce-result-count no encontrado.');
    }
}

function addPagination2() {
    // Encuentra el elemento por su clase
    const resultCountElement = document.querySelector('.woocommerce-result-count');

    // Verifica si el elemento existe y tiene contenido
    if (resultCountElement) {
        const text = resultCountElement.textContent;
        const regex = /Showing \d+–\d+ of (\d+) results/; // Esta expresión regular no debe cambiarse
        const matches = text.match(regex);

        if (matches) {
            // Extrae el total de resultados y lo convierte a número
            const totalResults = parseInt(matches[1], 10);

            // Divide el total de resultados por 12 y redondea hacia arriba para obtener el número total de páginas
            const pages = Math.ceil(totalResults / 12);

            // Muestra el resultado en la consola
            console.log('Total de páginas:', pages);

            // Detecta la página actual basada en la URL
            const currentPage = parseInt(window.location.pathname.match(/page\/(\d+)/)?.[1] || 1);

            // Encuentra el contenedor de los números de página
            const paginationContainer = document.querySelector('.lakit-pagination .page-numbers');

            console.log(currentPage);

            if (paginationContainer) {
                // Primero, elimina todos los elementos li existentes
                while (paginationContainer.firstChild) {
                    paginationContainer.removeChild(paginationContainer.firstChild);
                }

                // Añade el botón de página anterior si no estás en la primera página
                if (currentPage > 1) {
                    const prevPageItem = document.createElement('li');
                    prevPageItem.innerHTML = `<a class="prev page-numbers" href="#">←</a>`;
                    prevPageItem.addEventListener('click', (e) => {
                        e.preventDefault();
                        window.location.href = `${window.location.href}page/${currentPage - 1}`;
                    })
                    paginationContainer.appendChild(prevPageItem);
                }

                // Añade las páginas
                for (let i = 1; i <= pages; i++) {
                    const pageItem = document.createElement('li');
                    if (i === currentPage) {
                        pageItem.innerHTML = `<span aria-current="page" class="page-numbers current">${i}</span>`;
                    } else {
                        pageItem.innerHTML = `<a class="page-numbers" href="#">${i}</a>`;
                        pageItem.addEventListener('click', (e) => {
                            e.preventDefault();
                            window.location.href = `${window.location.href}page/${i}`;
                        })
                    }
                    paginationContainer.appendChild(pageItem);
                }

                // Añade el botón de página siguiente solo si no estás en la última página
                if (currentPage < pages) {
                    const nextPageItem = document.createElement('li');
                    nextPageItem.innerHTML = `<a class="next page-numbers" href="#}">→</a>`;
                    nextPageItem.addEventListener('click', (e) => {
                        e.preventDefault();
                        window.location.href = `${window.location.href}page/${currentPage + 1}`;
                    })
                    paginationContainer.appendChild(nextPageItem);
                }
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