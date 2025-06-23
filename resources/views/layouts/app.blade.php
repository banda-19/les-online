<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LesOnline</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="font-bold text-2xl text-indigo-600">
                    LesOnline
                </a>

                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Register</a>
                    @endguest

                  @auth
                        {{-- Link baru ke Dashboard --}}
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard Saya</a>

                        {{-- Pemisah --}}
                        <span class="text-gray-300">|</span>

                        {{-- Sapaan dan Tombol Logout --}}
                        <span class="text-gray-600">Halo, {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-indigo-600">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        {{-- INI BAGIAN YANG DIPERBAIKI --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @yield('content')
        </div>
    </main>

</body>
</html>