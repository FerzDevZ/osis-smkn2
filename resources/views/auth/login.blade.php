<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1F2A44] mb-2">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500">Silakan masuk untuk mengakses fitur eksklusif siswa.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <x-input-label for="email" value="Email Siswa" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="email" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <x-input-label for="password" value="Password" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-bold text-[#E6B656] hover:underline" href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mb-8">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#1F2A44] shadow-sm focus:ring-[#E6B656]" name="remember">
                <span class="ms-2 text-xs font-medium text-gray-500 group-hover:text-gray-700 transition">Ingat saya di perangkat ini</span>
            </label>
        </div>

        <div class="flex flex-col gap-4">
            <x-primary-button class="w-full justify-center py-4 bg-[#1F2A44] hover:bg-[#2D3C62] text-white rounded-2xl font-bold shadow-lg transition transform hover:-translate-y-1">
                Masuk ke Portal 
            </x-primary-button>
            
            <p class="text-center text-xs text-gray-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-[#E6B656] font-bold hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>
