<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'media',
            }
        </script>
    @endif
</head>

<body
    class="bg-gray-50 dark:bg-gray-900 text-[#1b1b18] dark:text-[#EDEDEC] min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 tracking-tight text-gray-900 dark:text-white">Portal Aplikasi</h1>
            <p class="text-lg text-gray-600 dark:text-gray-400">Silakan pilih aplikasi yang ingin Anda akses</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            {{-- Aplikasi Opname --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700">
                <div class="p-8 flex flex-col items-center text-center h-full">
                    <div
                        class="w-16 h-16 bg-blue-50 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Aplikasi Opname</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 flex-grow">Kelola dan pantau stok opname aset dengan
                        mudah dan akurat.</p>
                    <a href="{{ route('opname.dashboard') }}"
                        class="w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-medium transition-colors duration-200 shadow-lg shadow-blue-600/20">
                        Login Opname
                    </a>
                </div>
            </div>

            {{-- Aplikasi Keuangan --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700">
                <div class="p-8 flex flex-col items-center text-center h-full">
                    <div
                        class="w-16 h-16 bg-green-50 dark:bg-green-900/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 dark:text-green-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Aplikasi Keuangan</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 flex-grow">Sistem informasi keuangan terpadu untuk
                        pencatatan yang transparan.</p>
                    <a href="{{ route('finance.dashboard') }}"
                        class="w-full py-3 px-6 bg-green-600 hover:bg-green-700 text-white rounded-xl font-medium transition-colors duration-200 shadow-lg shadow-green-600/20">
                        Login Keuangan
                    </a>
                </div>
            </div>

            {{-- Aplikasi Manajemen Aset (Existing) --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden group border border-gray-100 dark:border-gray-700 relative ring-2 ring-primary-500/10">
                <div class="p-8 flex flex-col items-center text-center h-full">
                    <div
                        class="w-16 h-16 bg-purple-50 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 dark:text-purple-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-white">Manajemen Aset</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 flex-grow">Sistem pengelolaan aset inventaris yang
                        telah berjalan saat ini.</p>
                    <a href="{{ route('login') }}"
                        class="w-full py-3 px-6 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-medium transition-colors duration-200 shadow-lg shadow-purple-600/20">
                        Login Aset
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-16 text-center text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </div>
    </div>
</body>

</html>