<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

@if (session('success'))
    <div id="success-message"
         class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded" role="alert">
        <div class="flex items-center">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                                   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                </svg></div>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif
<div class="max-w-5xl mx-auto">

    <a href=""
       class="inline-flex items-center mb-6 text-gray-600 hover:text-blue-600 transition">
        <span class="mr-2">←</span> Back to Library
    </a>

    <div class="bg-white rounded-xl shadow-md p-8 mb-10 flex items-center gap-8">
        <div
            class="bg-blue-600 text-white w-24 h-24 rounded-full flex items-center justify-center text-4xl font-bold shadow-lg">
            {{ substr($user->name,0,1) }}
        </div>
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-1">{{ $user->name }}</h1>
            <p class="text-gray-500 mb-3">{{ $user->email }}</p>
            <div class="flex gap-2">
                    <span
                        class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        Department: {{ $user->departement }}
                    </span>
                <span
                    class="bg-purple-50 text-purple-700 text-xs font-bold px-3 py-1 rounded-full border border-purple-200">
                        Role: {{ $user->role }}
                    </span>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-end mb-6">
        <h2 class="text-2xl font-bold text-gray-800"> My Purchased items</h2>
        <span class="text-sm text-gray-500">You have  active loans</span>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="p-5">Book Name</th>
                <th class="p-5">Author</th>
                <th class="p-5">Borrowed Date</th>
                <th class="p-5">Return Due</th>
                <th class="p-5 text-center">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">

            </tbody>
        </table>
    </div>

</div>
<script src="{{ asset('js/member.js') }}"></script>

</body>

</html>
