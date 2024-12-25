<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('customcss')
</head>

<body class="bg-gray-100" x-data="{
    sidebarOpen: localStorage.getItem('sidebarOpen') === null ?
        (window.innerWidth >= 768) : localStorage.getItem('sidebarOpen') === 'true',
    checkScreen() {
        if (window.innerWidth < 768) {
            this.sidebarOpen = false;
        }
    }
}" x-init="checkScreen();
window.addEventListener('resize', () => checkScreen());
$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))">
    <div class="min-h-screen flex">
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

        <div x-cloak
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full md:translate-x-0': !sidebarOpen,
                'w-64': sidebarOpen,
                'w-20': !sidebarOpen
            }"
            class="fixed md:relative z-30 transition-all duration-300 ease-in-out transform">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <nav class="bg-white shadow-sm py-4 z-10">
                <div class="container mx-3">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="p-2 rounded-md hover:bg-gray-100 flex items-center justify-center">
                            <i class="material-icons">menu</i>
                        </button>
                    </div>
                </div>
            </nav>
            <main class="md:px-10 px-4 py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('customjs')
</body>

</html>
