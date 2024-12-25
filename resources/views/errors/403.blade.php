<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Forbidden</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-800">403</h1>
            <p class="text-2xl font-semibold text-gray-600 mt-4">Access Forbidden</p>
            <p class="text-gray-500 mt-4">Sorry, you don't have permission to access this page.</p>
            @if (Auth::user()->getRoleNames()[0] == 'admin' || Auth::user()->getRoleNames()[0] == 'super admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container]">
                    Return to Admin Panel
                </a>
            @elseif (Auth::user()->getRoleNames()[0] == 'member')
                <a href="{{ route('landing') }}"
                    class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container]">
                    Return Home
                </a>
            @else
                <a href="{{ route('landing') }}"
                    class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container]">
                    Return Home
                </a>
            @endif
            {{-- @auth
            @else
            @endauth --}}
        </div>
    </div>
</body>

</html>
