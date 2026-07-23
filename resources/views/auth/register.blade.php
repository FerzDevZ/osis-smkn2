<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#1F2A44] mb-2">Buat Akun Siswa</h2>
        <p class="text-sm text-gray-500">Daftarkan diri Anda untuk menjadi bagian dari ekosistem digital OSIS.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <x-input-label for="name" value="Nama Lengkap" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="name" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <x-input-label for="email" value="Email Siswa" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="email" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <x-input-label for="password" value="Password Baru" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="password" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Min. 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
            <x-text-input id="password_confirmation" class="block w-full bg-white/50 border-white/20 rounded-2xl p-4 text-sm focus:ring-[#E6B656]"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4">
            <x-primary-button class="w-full justify-center py-4 bg-[#1F2A44] hover:bg-[#2D3C62] text-white rounded-2xl font-bold shadow-lg transition transform hover:-translate-y-1">
                Daftar Sekarang
            </x-primary-button>
            
            <p class="text-center text-xs text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-[#E6B656] font-bold hover:underline">Masuk di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
