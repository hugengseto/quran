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

    <body class="bg-gray-50 text-slate-900">
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-emerald-600">MyQuran</a>
                <div class="text-sm text-gray-500 italic">By KaribDigital</div>
            </div>
        </nav>

        <main class="max-w-5xl mx-auto px-4 py-8">
            @yield('content')
        </main>

        <footer class="text-center py-10 text-gray-400 text-sm">
            &copy; {{ date('Y') }} - Dibuat dengan Laravel 12 & equran.id
        </footer>
    </body>

</html>
