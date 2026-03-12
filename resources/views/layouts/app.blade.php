<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing App</title>
    <!-- Tailwind CSS via CDN - responsive utility classes -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Lato:wght@300;400;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Syne', sans-serif;
        }
    </style>
</head>

<body class="bg-stone-50 min-h-screen">

    <!-- NAVIGATION - responsive with mobile menu -->
    <nav class="bg-white shadow-sm border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <a href="{{ route('houses.index') }}" class="text-xl font-bold text-red-700">
                    🏠 HousingApp
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <span class="hidden sm:block text-sm text-stone-500">
                            Hello, {{ Auth::user()->name }}
                        </span>
                        <a href="{{ route('houses.create') }}"
                            class="bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-semibold hover:bg-red-800 transition">
                            <span class="hidden sm:inline">+ List a House</span>
                            <span class="sm:hidden">+</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button class="text-stone-500 text-sm hover:text-stone-800 transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm text-stone-600 hover:text-red-700 transition">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-800 transition">
                            Register
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- FLASH SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-50 border-b border-green-200 px-4 py-3 text-center text-green-700 text-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    <!-- MAIN PAGE CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-stone-200 mt-16 py-8 text-center text-sm text-stone-400">
        © {{ date('Y') }} HousingApp — All rights reserved
    </footer>

</body>

</html>