<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">🛍️ Add New Product</h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Product Name --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full p-2 border border-gray-300 rounded">{{ old('description') }}</textarea>
            </div>

            {{-- Image --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Product Image</label>
                <input type="file" name="image"
                    class="w-full p-2 border border-gray-300 rounded bg-gray-50">
            </div>

            {{-- Price --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Price (Tokens)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                    class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}"
                    class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            {{-- Type --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Product Type</label>
                <select name="type" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Select type</option>
                    <option value="standard" @selected(old('type') === 'standard')>Standard</option>
                    <option value="premium" @selected(old('type') === 'premium')>Premium</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex justify-between items-center">
                <a href="{{ route('products.index') }}"
                    class="text-gray-500 hover:text-gray-700">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">
                    Save Product
                </button>
            </div>
        </form>
    </div>

</body>

</html>
