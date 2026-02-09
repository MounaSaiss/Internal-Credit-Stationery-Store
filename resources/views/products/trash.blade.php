<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trash Bin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-red-600">🗑️ Deleted Products (Trash)</h1>
            <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-blue-600">← Back to Products</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="p-3">Product Name</th>
                    <th class="p-3">Deleted At</th>
                    <th class="p-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($deletedProducts as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-bold text-gray-700">{{ $product->name }}</td>
                        <td class="p-3 text-red-500 text-sm">{{ $product->deleted_at->diffForHumans() }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('products.restore', $product->id) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm font-bold shadow">
                                ♻️ Restore
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-6 text-center text-gray-500">Trash is empty.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>

