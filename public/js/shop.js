
document.addEventListener('DOMContentLoaded', function () {
    const toasts = document.querySelectorAll('[id^="toast-"]');

    toasts.forEach(toast => {
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');

            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    });


    const SearchProduct = document.getElementById('SearchProduct');

    SearchProduct.addEventListener('input', function (e) {
        let value = e.target.value;

        fetch(`/shop/product/search/${value}`)
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
            }).then(data => {
                renderData(data);
            })
    });


    function renderData(data) {
        const product_carts = document.getElementById('product_carts');

        product_carts.innerHTML = '';

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        console.log(csrfToken);
        console.log('test');
        data.forEach(product => {
            const showUrl = `/shop/product/${product.id}`;
            const cartUrl = `/cart/add/${product.id}`;
            const imagePath = `/images/${product.image}`;

            product_carts.innerHTML += `
                 <div class="product-card group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-400 transition-all duration-300 flex flex-col overflow-hidden relative">

                    <a href="${showUrl}" class="block relative h-48 bg-gray-50 overflow-hidden border-b border-gray-100">
                        <div class="relative h-48 bg-gray-50 overflow-hidden border-b border-gray-100">
                            ${product.image ?
                    `<img src="${imagePath}" alt="${product.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">`
                    :
                    `<div class="flex items-center justify-center h-full text-gray-300">
                                    <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>`
                }

                            ${product.type === 'premium' ?
                    `<div class="premium-badge absolute top-3 left-3 backdrop-blur-sm text-yellow-400 text-[10px] font-bold px-2 py-1 rounded shadow-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    PREMIUM
                                </div>`
                    : ''
                }
                        </div>
                    </a>

                    <div class="p-4 flex-1 flex flex-col">
                        <div class="mb-3">
                            <a href="${showUrl}">
                                <h3 class="text-base font-bold text-gray-900 mb-1 leading-tight hover:text-blue-600 transition-colors">
                                    ${product.name}
                                </h3>
                            </a>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">${product.description}</p>
                        </div>

                        <form action="${cartUrl}" method="POST" class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between gap-3">
                            
                            <input type="hidden" name="_token" value="${csrfToken}">

                            <div class="flex flex-col">
                                <span class="text-lg font-bold text-gray-900">${product.price}</span>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Tokens</span>
                            </div>

                            <button type="submit" class="add-to-cart-btn bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition-colors shadow-sm flex items-center gap-2">
                                <span>Ajouter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            `;
        })
    }
});
