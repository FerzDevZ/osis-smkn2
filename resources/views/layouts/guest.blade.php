<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk / Daftar - OSIS SMKN 2</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 text-[#1A2233] overflow-hidden">
    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-500/5 blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-orange-500/5 blur-[120px] animate-pulse"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8 transform hover:scale-110 transition-transform">
            <a href="/" class="font-display font-black text-3xl tracking-tighter text-[#1F2A44] uppercase">
                SMKN 2 <span class="text-[#E6B656]">OSIS</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md glass rounded-[2.5rem] shadow-2xl border-white/20 p-8 md:p-10 animate-fade-in">
            {{ $slot }}
        </div>
        
        <div class="mt-8 text-xs text-gray-400 font-bold uppercase tracking-[0.3em]">
            Digital Ecosystem SMKN 2
        </div>
    </div>
</body>
</html>
