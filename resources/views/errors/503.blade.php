<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <title>503 - Service Unavailable</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-800">503</h1>
            <p class="text-2xl font-semibold text-gray-600 mt-4">Service Unavailable</p>
            <p class="text-gray-500 mt-4">Sorry, we're doing some maintenance. Please check back soon.</p>
            @auth
                @if (auth()->user()->hasRole(['admin', 'super admin']))
                    <a href="{{ route('admin.dashboard') }}"
                        class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                        Return to Admin Panel
                    </a>
                @else
                    <a href="{{ route('landing') }}"
                        class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                        Return Home
                    </a>
                @endif
            @else
                <a href="{{ route('landing') }}"
                    class="inline-block bg-[--primary] text-[--on-primary] font-bold px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                    Return Home
                </a>
            @endauth
        </div>
    </div>
</body>

</html>
