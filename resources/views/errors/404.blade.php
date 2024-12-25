<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-800">404</h1>
            <p class="text-2xl font-semibold text-gray-600 mt-4">Page Not Found</p>
            <p class="text-gray-500 mt-4">The page you're looking for doesn't exist or has been moved.</p>
            <a href="{{ route('landing') }}"
                class="inline-block bg-[--primary] text-white px-6 py-3 rounded-lg mt-8 hover:bg-[--primary-container]">
                Return Home
            </a>
        </div>
    </div>
</body>

</html>
