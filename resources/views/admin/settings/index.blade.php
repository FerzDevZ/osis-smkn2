@extends('layouts.app')
@section('title', 'Manajemen Pengaturan Situs - OSIS SMKN 2')
@section('content')
<div class="py-12 px-4 min-h-screen" x-data="{ tab: 'umum' }">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 animate-fade-in flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-primary dark:text-white mb-2">Konfigurasi <span class="text-accent2">Situs</span></h1>
                <p class="text-ink/60 dark:text-white/40 font-medium italic">Kustomisasi seluruh konten website OSIS Anda dalam satu tempat.</p>
            </div>
            @if(session('status'))
                <div class="glass px-6 py-3 rounded-2xl text-xs font-bold text-green-600 dark:text-green-400 flex items-center gap-3">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <!-- Tab Navigation -->
        <div class="flex flex-wrap gap-2 mb-10 pb-4 overflow-x-auto no-scrollbar animate-fade-in" style="animation-delay: 100ms;">
            <button @click="tab = 'umum'" :class="tab === 'umum' ? 'bg-primary text-white shadow-lg' : 'glass text-ink/60 dark:text-white/40 hover:bg-white/50'" class="px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all">🌐 Umum</button>
            <button @click="tab = 'hero'" :class="tab === 'hero' ? 'bg-primary text-white shadow-lg' : 'glass text-ink/60 dark:text-white/40 hover:bg-white/50'" class="px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all">✨ Hero</button>
            <button @click="tab = 'tentang'" :class="tab === 'tentang' ? 'bg-primary text-white shadow-lg' : 'glass text-ink/60 dark:text-white/40 hover:bg-white/50'" class="px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all">📖 Tentang</button>
            <button @click="tab = 'sections'" :class="tab === 'sections' ? 'bg-primary text-white shadow-lg' : 'glass text-ink/60 dark:text-white/40 hover:bg-white/50'" class="px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all">📦 Sections</button>
            <button @click="tab = 'sosmed'" :class="tab === 'sosmed' ? 'bg-primary text-white shadow-lg' : 'glass text-ink/60 dark:text-white/40 hover:bg-white/50'" class="px-6 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest transition-all">📱 Kontak</button>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="animate-fade-in" style="animation-delay: 200ms;">
            @csrf
            
            <!-- Tab: Umum -->
            <div x-show="tab === 'umum'" x-transition class="space-y-8">
                <div class="glass rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-glass">
                    <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                        <span class="p-2 bg-primary/10 rounded-xl text-lg">ℹ️</span> Informasi Dasar
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Nama Situs</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Nama Sekolah</label>
                            <input type="text" name="school_name" value="{{ $settings['school_name'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Deskripsi Footer</label>
                            <textarea name="footer_text" rows="3" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">{{ $settings['footer_text'] ?? '' }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">SEO Meta Description</label>
                            <textarea name="seo_meta_description" rows="2" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm italic">{{ $settings['seo_meta_description'] ?? '' }}</textarea>
                            <p class="mt-2 ml-2 text-[9px] font-bold text-ink/30 dark:text-white/30 uppercase tracking-tighter">*Deskripsi yang akan muncul di hasil pencarian Google.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Hero -->
            <div x-show="tab === 'hero'" x-transition class="space-y-8">
                <div class="glass rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-glass">
                    <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                        <span class="p-2 bg-accent2/10 rounded-xl text-lg">✨</span> Konfigurasi Hero Page
                    </h3>
                    <div class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Judul Utama (Title)</label>
                            <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm font-bold">
                            <p class="mt-2 ml-2 text-[9px] text-accent2 font-bold uppercase tracking-tighter">Tip: Gunakan &lt;span class="text-accent2"&gt;kata&lt;/span&gt; untuk warna aksen.</p>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Sub-Judul (Subtitle)</label>
                            <textarea name="hero_subtitle" rows="3" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Tentang -->
            <div x-show="tab === 'tentang'" x-transition class="space-y-8">
                <div class="glass rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-glass">
                    <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                        <span class="p-2 bg-blue-500/10 rounded-xl text-lg">📖</span> Halaman Tentang OSIS
                    </h3>
                    <div class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Judul Halaman</label>
                            <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Deskripsi Utama</label>
                            <textarea name="about_description" rows="4" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">{{ $settings['about_description'] ?? '' }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Visi</label>
                                <textarea name="about_vision" rows="4" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">{{ $settings['about_vision'] ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-3 ml-2">Misi</label>
                                <textarea name="about_mission" rows="4" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-primary transition-all dark:text-white text-sm">{{ $settings['about_mission'] ?? '' }}</textarea>
                                <p class="mt-2 ml-2 text-[9px] font-bold text-ink/30 dark:text-white/30 uppercase tracking-tighter">*Gunakan Enter untuk setiap poin misi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Sections -->
            <div x-show="tab === 'sections'" x-transition class="space-y-8">
                <div class="glass rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-glass">
                    <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                        <span class="p-2 bg-orange-500/10 rounded-xl text-lg">📦</span> Judul Section Landing Page
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- News Section -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-primary dark:text-accent2 uppercase tracking-widest mb-4 border-b pb-2">Berita Section</h4>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Title</label>
                                <input type="text" name="section_news_title" value="{{ $settings['section_news_title'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Subtitle</label>
                                <input type="text" name="section_news_subtitle" value="{{ $settings['section_news_subtitle'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                        </div>
                        <!-- Events Section -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-primary dark:text-accent2 uppercase tracking-widest mb-4 border-b pb-2">Event Section</h4>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Title</label>
                                <input type="text" name="section_events_title" value="{{ $settings['section_events_title'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Subtitle</label>
                                <input type="text" name="section_events_subtitle" value="{{ $settings['section_events_subtitle'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                        </div>
                        <!-- Gallery Section -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-primary dark:text-accent2 uppercase tracking-widest mb-4 border-b pb-2">Gallery Section</h4>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Title</label>
                                <input type="text" name="section_gallery_title" value="{{ $settings['section_gallery_title'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Subtitle</label>
                                <input type="text" name="section_gallery_subtitle" value="{{ $settings['section_gallery_subtitle'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                        </div>
                        <!-- Suara Siswa Section -->
                        <div class="space-y-4">
                            <h4 class="text-xs font-bold text-primary dark:text-accent2 uppercase tracking-widest mb-4 border-b pb-2">Suara Siswa Section</h4>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Title</label>
                                <input type="text" name="section_suara_title" value="{{ $settings['section_suara_title'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[9px] font-bold uppercase tracking-widest text-ink/40 mb-1 ml-1">Subtitle</label>
                                <input type="text" name="section_suara_subtitle" value="{{ $settings['section_suara_subtitle'] ?? '' }}" class="w-full bg-white/30 dark:bg-neutral-800/30 border-black/5 rounded-xl px-4 py-2 text-xs dark:text-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Sosmed & Kontak -->
            <div x-show="tab === 'sosmed'" x-transition class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Social Media -->
                    <div class="glass rounded-[2rem] p-8 border border-white/20 shadow-glass">
                        <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                            <span class="p-2 bg-pink-500/10 rounded-xl text-lg">📲</span> Social Media
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-2 ml-2">Instagram URL</label>
                                <input type="text" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-5 py-3 text-sm dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-2 ml-2">TikTok URL</label>
                                <input type="text" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-5 py-3 text-sm dark:text-white">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details -->
                    <div class="glass rounded-[2rem] p-8 border border-white/20 shadow-glass">
                        <h3 class="text-xl font-bold mb-8 flex items-center gap-3 dark:text-white">
                            <span class="p-2 bg-blue-500/10 rounded-xl text-lg">✉️</span> Hubungi Kami
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-2 ml-2">Email Official</label>
                                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-5 py-3 text-sm dark:text-white">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-ink/40 dark:text-white/40 mb-2 ml-2">Alamat Sekolah</label>
                                <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? '' }}" class="w-full bg-white/50 dark:bg-neutral-800/50 border-black/5 dark:border-white/10 rounded-2xl px-5 py-3 text-sm dark:text-white">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-12 flex justify-center sticky bottom-8 z-30">
                <button type="submit" class="bg-primary text-white font-black px-12 py-5 rounded-3xl shadow-2xl shadow-primary/40 hover:scale-105 active:scale-95 transition-all text-sm uppercase tracking-[0.2em]">
                    💾 Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
