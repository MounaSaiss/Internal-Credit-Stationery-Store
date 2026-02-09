<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Product: {{ $product->name }}</h2>

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

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Price --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Price (MAD)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Stock --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            {{-- Type --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Product Type</label>
                <select name="type" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="standard" @selected(old('type', $product->type) === 'standard')>Standard</option>
                    <option value="premium" @selected(old('type', $product->type) === 'premium')>Premium</option>
                </select>
            </div>

            {{-- Current Image --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Product Image</label>
                @if($product->image)
                    <div class="mb-2 p-2 border rounded bg-gray-50">
                        <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}" class="h-24 rounded">
                    </div>
                @endif

                <input type="file" name="image" class="w-full border p-2 rounded bg-white">
                <p class="text-xs text-gray-500 mt-1">Leave empty if you don't want to change the image.</p>
            </div>

            {{-- Actions --}}
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">
                    Cancel
                </a>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold shadow transition">
                    Update Product
                </button>
            </div>

        </form>
    </div>

</body>
</html>
