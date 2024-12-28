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
    @livewireStyles
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
    <div class="min-h-screen flex overflow-hidden">
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"></div>

        <div x-cloak
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full md:translate-x-0': !sidebarOpen,
                'w-64': sidebarOpen,
                'w-20': !sidebarOpen
            }"
            class="fixed inset-y-0 left-0 z-30 transition-all duration-300 ease-in-out transform">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col" :class="{ 'md:ml-64': sidebarOpen, 'md:ml-20': !sidebarOpen }">
            <nav class="sticky top-0 bg-white shadow-sm py-4 z-20">
                <div class="px-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="p-2 rounded-md hover:bg-gray-100 flex items-center justify-center">
                            <i class="material-icons">menu</i>
                        </button>
                    </div>
                </div>
            </nav>
            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('customjs')
    @livewireScripts
</body>

</html>
