<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal OSIS SMKN 2 Pangkalpinang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-[#1A2233]">
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <div class="text-center max-w-2xl animate-fade-in">
            <h1 class="font-display font-black text-5xl md:text-7xl text-[#1F2A44] mb-6 uppercase tracking-tighter">
                SMKN 2 <span class="text-[#E6B656]">OSIS</span>
            </h1>
            <p class="text-lg text-gray-500 mb-10 leading-relaxed">
                Platform ekosistem digital terpadu untuk kreativitas, transparansi, dan kolaborasi siswa SMKN 2 Pangkalpinang.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-[#1F2A44] text-white px-10 py-4 rounded-full font-bold shadow-xl hover:opacity-90 transition transform hover:-translate-y-1">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="bg-[#1F2A44] text-white px-10 py-4 rounded-full font-bold shadow-xl hover:opacity-90 transition transform hover:-translate-y-1">Masuk Portal</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-[#1F2A44] px-10 py-4 rounded-full font-bold shadow-lg border border-gray-200 hover:bg-gray-50 transition transform hover:-translate-y-1">Daftar Akun</a>
                    @endif
                @endauth
            </div>
        </div>
        <div class="mt-20 text-xs font-bold text-gray-400 uppercase tracking-[0.4em]">
            Official Digital Platform 2026
        </div>
    </div>
</body>
</html>
