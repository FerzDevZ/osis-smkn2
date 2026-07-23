@extends('layouts.app')
@section('title', ($site_settings['about_title'] ?? 'Tentang OSIS') . ' - ' . ($site_settings['site_name'] ?? 'SMKN 2'))
@section('content')

<div class="py-24 px-4 min-h-screen relative overflow-hidden bg-bg">
    <!-- Premium background decoration -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 blur-[120px] -z-10 rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-accent/5 blur-[120px] -z-10 rounded-full"></div>

    <section class="max-w-5xl mx-auto">
        <!-- Humanized Header Section -->
        <div class="mb-24 animate-fade-in text-center">
            <span class="text-accent font-bold uppercase tracking-[0.4em] text-[10px] mb-6 block">Keluarga Besar OSIS</span>
            <h1 class="text-5xl md:text-8xl font-display font-black text-primary dark:text-white mb-8 tracking-tight uppercase italic">
                Lebih dari <span class="text-accent">Sekadar</span> Organisasi.
            </h1>
            <div class="h-1 w-20 bg-accent mx-auto mb-10 rounded-full"></div>
            <p class="text-xl md:text-2xl text-text-muted leading-relaxed max-w-3xl mx-auto font-medium">
                Kami adalah wadah bagi setiap ide gila, ambisi besar, dan semangat kolaborasi siswa SMKN 2 Pangkalpinang. OSIS bukan hanya tentang jabatan, tapi tentang dampak nyata.
            </p>
        </div>

        <!-- Vision and Mission Grid with Premium Style -->
        <div class="grid md:grid-cols-2 gap-12 mb-24">
            <!-- Vision -->
            <div class="glass p-12 rounded-[3rem] border-white/20 shadow-xl relative group overflow-hidden animate-fade-in" style="animation-delay: 200ms;">
                <div class="relative z-10">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-accent mb-6">Masa Depan</h2>
                    <h3 class="text-4xl font-display font-bold text-primary dark:text-white mb-8">Visi Utama</h3>
                    <p class="text-xl text-text leading-relaxed font-serif italic border-l-4 border-accent pl-8 py-2">
                        {{ $site_settings['about_vision'] ?? 'Mewujudkan ekosistem siswa yang berani berinovasi, adaptif terhadap teknologi, dan menjunjung tinggi integritas karakter.' }}
                    </p>
                </div>
            </div>

            <!-- Mission -->
            <div class="glass p-12 rounded-[3rem] border-white/20 shadow-xl relative group overflow-hidden animate-fade-in" style="animation-delay: 400ms;">
                <div class="relative z-10">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.5em] text-accent mb-6">Langkah Nyata</h2>
                    <h3 class="text-4xl font-display font-bold text-primary dark:text-white mb-8">Misi Kami</h3>
                    <ul class="space-y-8">
                        @php
                            $missions = explode("\n", $site_settings['about_mission'] ?? "Menciptakan ruang kolaborasi lintas jurusan.\nMemanfaatkan teknologi digital untuk transparansi.\nMenjadi jembatan aspirasi yang responsif.");
                        @endphp
                        @foreach($missions as $m)
                            @if(trim($m))
                                <li class="flex items-start gap-6 group/item">
                                    <span class="text-3xl font-display font-black text-accent/20 group-hover/item:text-accent transition-colors duration-500">
                                        0{{ $loop->iteration }}
                                    </span>
                                    <span class="text-text font-bold leading-tight pt-2">{{ trim($m) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- The 'Why' Section - More Human -->
        <div class="mb-24 py-16 px-8 rounded-[4rem] bg-primary text-white relative overflow-hidden animate-fade-in" style="animation-delay: 500ms;">
            <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-50"></div>
            <div class="relative z-10 max-w-2xl">
                <h2 class="text-4xl font-display font-bold mb-6 italic uppercase">Mengapa Kami Ada?</h2>
                <p class="text-white/70 text-lg leading-relaxed mb-8">
                    Sekolah bukan hanya tempat belajar di dalam kelas. Kami percaya setiap siswa punya potensi yang menunggu untuk diledakkan. OSIS hadir untuk memastikan tidak ada talenta yang terbuang sia-sia di SMKN 2 Pangkalpinang.
                </p>
                <div class="flex gap-12">
                    <div>
                        <div class="text-4xl font-black text-accent mb-1">50+</div>
                        <div class="text-[10px] uppercase font-bold tracking-widest text-white/50">Pengurus Aktif</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-accent mb-1">10+</div>
                        <div class="text-[10px] uppercase font-bold tracking-widest text-white/50">Sekbid & Divisi</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-accent mb-1">∞</div>
                        <div class="text-[10px] uppercase font-bold tracking-widest text-white/50">Ide Kreatif</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Clean Contact Section -->
        <div class="glass p-12 rounded-[3.5rem] border-white/20 shadow-xl animate-fade-in" style="animation-delay: 600ms;">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-display font-bold text-primary dark:text-white mb-3">Terhubung dengan Kami</h2>
                    <p class="text-text-muted text-sm font-medium">Bukan sekadar formalitas, kami benar-benar menunggu suaramu.</p>
                </div>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="mailto:{{ $site_settings['contact_email'] ?? 'osis@smkn2pp.sch.id' }}" class="flex items-center gap-4 px-8 py-4 rounded-2xl bg-primary text-white hover:opacity-90 active:scale-95 transition-all">
                        <div class="text-left">
                            <span class="block text-[8px] font-bold uppercase tracking-widest text-white/50">Email Resmi</span>
                            <span class="block font-bold text-sm">{{ $site_settings['contact_email'] ?? 'osis@smkn2pp.sch.id' }}</span>
                        </div>
                    </a>

                    <a href="{{ $site_settings['instagram_url'] ?? '#' }}" target="_blank" class="flex items-center gap-4 px-8 py-4 rounded-2xl glass border border-white/30 hover:bg-white active:scale-95 transition-all">
                        <div class="text-left">
                            <span class="block text-[8px] font-bold uppercase tracking-widest text-text-muted">Instagram</span>
                            <span class="block font-bold text-sm text-primary">{{ '@' . (collect(explode('/', rtrim($site_settings['instagram_url'] ?? '', '/')))->last() ?: 'osis_smkn2pp') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
