@extends('layouts.app')
@section('title', ($site_settings['about_title'] ?? 'Tentang OSIS') . ' - ' . ($site_settings['site_name'] ?? 'SMKN 2'))
@section('content')

<div class="py-24 px-4 min-h-screen relative overflow-hidden">
    <!-- background decoration -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 blur-[120px] -z-10"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent2/5 blur-[120px] -z-10"></div>

    <section class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-20 animate-fade-in">
            <span class="text-accent2 font-bold uppercase tracking-[0.3em] text-xs mb-4 block">Kenali Kami Lebih Dekat</span>
            <h1 class="text-4xl md:text-7xl font-display font-bold text-primary dark:text-white mb-8 tracking-tighter">
                {{ $site_settings['about_title'] ?? 'Tentang OSIS SMKN 2 Pangkalpinang' }}
            </h1>
            <p class="text-lg md:text-xl text-ink/70 dark:text-white/60 leading-relaxed max-w-4xl mx-auto italic">
                "{{ $site_settings['about_description'] ?? 'Wadah pengembangan potensi siswa melalui kolaborasi, kreativitas, dan kebermanfaatan.' }}"
            </p>
        </div>

        <!-- Vision and Mission Grid -->
        <div class="grid md:grid-cols-2 gap-8 mb-20">
            <!-- Vision -->
            <div class="glass p-10 md:p-14 rounded-[3rem] border border-white/20 shadow-glass relative group overflow-hidden animate-fade-in" style="animation-delay: 200ms;">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/10 blur-3xl group-hover:bg-primary/20 transition-all"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-primary text-white flex items-center justify-center mb-8 text-3xl shadow-xl shadow-primary/20 transform group-hover:rotate-6 transition-transform">
                        🎯
                    </div>
                    <h2 class="text-3xl font-display font-bold text-primary dark:text-white mb-6">Visi Kami</h2>
                    <p class="text-lg text-ink/70 dark:text-white/70 italic leading-relaxed border-l-4 border-accent2 pl-6">
                        {{ $site_settings['about_vision'] ?? 'Mewujudkan organisasi siswa yang adaptif, inspiratif, dan berintegritas.' }}
                    </p>
                </div>
            </div>

            <!-- Mission -->
            <div class="glass p-10 md:p-14 rounded-[3rem] border border-white/20 shadow-glass relative group overflow-hidden animate-fade-in" style="animation-delay: 400ms;">
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-accent2/10 blur-3xl group-hover:bg-accent2/20 transition-all"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-accent2 text-primary flex items-center justify-center mb-8 text-3xl shadow-xl shadow-accent2/20 transform group-hover:-rotate-6 transition-transform">
                        🚀
                    </div>
                    <h2 class="text-3xl font-display font-bold text-primary dark:text-white mb-6">Misi Kami</h2>
                    <ul class="space-y-6">
                        @php
                            $missions = explode("\n", $site_settings['about_mission'] ?? "Menumbuhkan budaya kolaborasi.\nMendorong kreativitas.\nMemfasilitasi aspirasi.");
                        @endphp
                        @foreach($missions as $m)
                            @if(trim($m))
                                <li class="flex items-start gap-4 group/item">
                                    <span class="w-6 h-6 rounded-full bg-accent1/10 text-accent1 flex items-center justify-center text-[10px] mt-1 shrink-0 font-bold group-hover/item:bg-accent1 group-hover/item:text-white transition-all">
                                        {{ $loop->iteration }}
                                    </span>
                                    <span class="text-ink/70 dark:text-white/80 font-medium leading-relaxed">{{ trim($m) }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact & Interaction Section -->
        <div class="glass p-10 md:p-16 rounded-[3.5rem] border border-white/20 shadow-glass animate-fade-in" style="animation-delay: 600ms;">
            <div class="flex flex-col md:flex-row items-center justify-between gap-12">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-display font-bold text-primary dark:text-white mb-4">Ingin berkolaborasi?</h2>
                    <p class="text-ink/60 dark:text-white/40 max-w-md italic">Kami selalu terbuka untuk ide baru, saran, atau kerja sama untuk memajukan sekolah kita.</p>
                </div>
                
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="mailto:{{ $site_settings['contact_email'] ?? 'osis@smkn2pp.sch.id' }}" class="flex items-center gap-4 px-8 py-4 rounded-3xl bg-white/50 dark:bg-white/5 hover:bg-white active:scale-95 transition-all group">
                        <span class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-xl group-hover:bg-primary group-hover:text-white transition-all">📧</span>
                        <div class="text-left">
                            <span class="block text-[10px] font-bold uppercase tracking-widest text-ink/40">Email Kami</span>
                            <span class="block font-bold dark:text-white text-sm">{{ $site_settings['contact_email'] ?? 'osis@smkn2pp.sch.id' }}</span>
                        </div>
                    </a>

                    <a href="{{ $site_settings['instagram_url'] ?? '#' }}" target="_blank" class="flex items-center gap-4 px-8 py-4 rounded-3xl bg-white/50 dark:bg-white/5 hover:bg-white active:scale-95 transition-all group">
                        <span class="w-10 h-10 rounded-xl bg-pink-500/10 text-pink-500 flex items-center justify-center text-xl group-hover:bg-pink-500 group-hover:text-white transition-all">📸</span>
                        <div class="text-left">
                            <span class="block text-[10px] font-bold uppercase tracking-widest text-ink/40">Instagram</span>
                            <span class="block font-bold dark:text-white text-sm">{{ '@' . (collect(explode('/', rtrim($site_settings['instagram_url'] ?? '', '/')))->last() ?: 'osis_smkn2pp') }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
        opacity: 0;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection
