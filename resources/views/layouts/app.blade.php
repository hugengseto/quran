<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Al-Quran Digital - Portfolio Hugeng Seto</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Inter:wght@400;600;700&display=swap"
            rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .font-arabic {
                font-family: 'Amiri', serif;
            }

            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>

    <body class="bg-gray-50 text-slate-900" x-data="{ showTopBtn: false }"
        @scroll.window="showTopBtn = (window.pageYOffset > 500)">
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-emerald-600">MyQuran</a>
                <div class="text-sm text-gray-500 italic">By <a href="http://hugengseto.com" target="_blank"
                        rel="noopener noreferrer" class="text-emerald-600">hugengseto</a></div>
            </div>
        </nav>

        <main class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>

        <footer class="text-center py-10 text-gray-400 text-sm">
            &copy; {{ date('Y') }} - Dibuat dengan Laravel 13 & TailwindCSS 4. Sumber API dari <a
                href="https://equran.id/" class="text-emerald-600" target="_blank" rel="noopener noreferrer">
                equran.id</a>
        </footer>

        <button x-show="showTopBtn" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-10" @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 z-50 p-3.5 bg-emerald-600 text-white rounded-full shadow-lg hover:bg-emerald-700 hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
            title="Kembali ke Atas">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </body>

</html>
