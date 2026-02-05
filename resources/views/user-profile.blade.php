<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛍️</text></svg>">
</head>

<body class="antialiased bg-gray-50 text-gray-800 font-figtree">

@if (session('success'))
    <div id="success-message" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded"
         role="alert">
        <div class="flex items-center">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg>
            </div>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif
<div class="max-w-5xl mx-auto">

    <a href="{{ route('user.dashboard', ['username' => Auth::user()->name]) }}"
       class="inline-flex items-center mb-6 text-gray-600 hover:text-blue-600 transition">
        <span class="mr-2">←</span> Back to Dashboard
    </a>

    <div class="bg-white rounded-xl shadow-md p-8 mb-10 flex items-center gap-8">
        <div
            class="bg-blue-600 text-white w-24 h-24 rounded-full flex items-center justify-center text-4xl font-bold shadow-lg">
            {{ substr($user->name, 0, 1) }}
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
            <p class="text-gray-500 mb-3">{{ $user->email }}</p>
            <div class="flex gap-2">
                    <span
                        class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        Department: {{ $user->department }}
                    </span>
                <span
                    class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
                        Role: {{ $user->role }}
                    </span>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-end mb-6">
        <h2 class="text-2xl font-bold text-gray-800">My Purchased products</h2>

        <!-- Search Bar -->
        <div class="relative">
            <input
                type="text"
                id="searchInput"
                placeholder="Search products..."
                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left" id="productsTable">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition" data-sort="name">
                        Product Name
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition" data-sort="quantity">
                        Quantity
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition" data-sort="price">
                        Price
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition" data-sort="status">
                        Status
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
                <th class="p-5 text-center">
                    <button class="sort-header flex items-center gap-2 hover:text-gray-700 transition mx-auto" data-sort="date">
                        Date
                        <span class="sort-arrow">↕</span>
                    </button>
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
                @foreach ($order->items as $item)
                    <tr class="hover:bg-gray-50 transition product-row"
                        data-status="{{ $item->status }}"
                        data-name="{{ $item->product->name }}"
                        data-quantity="{{ $item->quantity }}"
                        data-price="{{ ($item->product->price) * ($item->quantity) }}"
                        data-date="{{ $order->updated_at }}"
                    >
                        <td class="p-5 font-bold text-gray-800 product-name">
                            {{ $item->product->name }}
                        </td>

                        <td class="p-5 text-gray-600">
                            {{ $item->quantity }}
                        </td>

                        <td class="p-5 text-sm text-gray-600">
                            {{ ($item->product->price) * ($item->quantity) }} $
                        </td>

                        <td class="p-5">
                                    <span @class([
                                        'text-sm font-medium px-2 py-1 rounded',
                                        'text-yellow-600 bg-yellow-50' => $item->status === 'waiting',
                                        'text-green-600 bg-green-50' => $item->status === 'valid',
                                        'text-red-600 bg-red-50' => $item->status === 'rejected',
                                    ])>
                            {{ $item->status }}
                                    </span>
                        </td>

                        <td class="p-5 text-center">
                            {{ $order->updated_at }}
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr id="emptyRow">
                    <td class="p-10 text-center text-gray-400 italic" colspan="5">
                        <div class="flex flex-col items-center"><span class="text-4xl mb-2">🛒</span>
                            <p>You haven't bought any products recently.</p> <a href=""
                                                                                class="text-blue-600 text-sm hover:underline mt-2">Browse
                                Catalog</a>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>

        </table>

        <!-- No results message (hidden by default) -->
        <div id="noResults" class="p-10 text-center text-gray-400 italic hidden">
            <div class="flex flex-col items-center">
                <span class="text-4xl mb-2">🔍</span>
                <p>No products found matching your search.</p>
            </div>
        </div>
    </div>

</div>

<script>
    let currentSort = null;
    let sortDirection = 'asc';

    // Status priority for sorting
    const statusPriority = {
        'valid': 1,
        'waiting': 2,
        'rejected': 3
    };

    // Search functionality
    function filterProducts() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.product-row');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        rows.forEach(row => {
            const productName = row.getAttribute('data-name').toLowerCase();

            if (productName.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0 && rows.length > 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    // Sort functionality
    function sortTable(column) {
        const tbody = document.querySelector('#productsTable tbody');
        const rows = Array.from(document.querySelectorAll('.product-row'));

        // Toggle direction if clicking same column
        if (currentSort === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortDirection = 'asc';
            currentSort = column;
        }

        // Sort rows
        rows.sort((a, b) => {
            let aVal, bVal;

            if (column === 'name') {
                aVal = a.getAttribute('data-name').toLowerCase();
                bVal = b.getAttribute('data-name').toLowerCase();
                return sortDirection === 'asc'
                    ? aVal.localeCompare(bVal)
                    : bVal.localeCompare(aVal);
            }
            else if (column === 'quantity' || column === 'price') {
                aVal = parseFloat(a.getAttribute('data-' + column));
                bVal = parseFloat(b.getAttribute('data-' + column));
                return sortDirection === 'asc'
                    ? aVal - bVal
                    : bVal - aVal;
            }
            else if (column === 'status') {
                aVal = statusPriority[a.getAttribute('data-status')];
                bVal = statusPriority[b.getAttribute('data-status')];
                return sortDirection === 'asc'
                    ? aVal - bVal
                    : bVal - aVal;
            }
            else if (column === 'date') {
                aVal = new Date(a.getAttribute('data-date'));
                bVal = new Date(b.getAttribute('data-date'));
                return sortDirection === 'asc'
                    ? aVal - bVal
                    : bVal - aVal;
            }
        });

        // Update arrows
        document.querySelectorAll('.sort-arrow').forEach(arrow => {
            arrow.textContent = '↕';
            arrow.style.opacity = '0.3';
        });

        const activeButton = document.querySelector(`[data-sort="${column}"]`);
        const activeArrow = activeButton.querySelector('.sort-arrow');
        activeArrow.textContent = sortDirection === 'asc' ? '↑' : '↓';
        activeArrow.style.opacity = '1';

        // Re-append rows in sorted order
        rows.forEach(row => tbody.appendChild(row));
    }

    // Add event listeners
    document.getElementById('searchInput').addEventListener('keyup', filterProducts);

    document.querySelectorAll('.sort-header').forEach(button => {
        button.addEventListener('click', function() {
            const column = this.getAttribute('data-sort');
            sortTable(column);
        });
    });

    // Set initial arrow opacity
    document.querySelectorAll('.sort-arrow').forEach(arrow => {
        arrow.style.opacity = '0.3';
    });
</script>

<script src="{{ asset('js/member.js') }}"></script>

</body>

</html>
