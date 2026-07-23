@extends('layouts.app')

@section('title', 'Identity Studio • SMKN 2')

@section('content')
<!-- THE STUDIO WRAPPER -->
<div class="min-h-screen bg-[#08090a] text-slate-200 selection:bg-primary selection:text-white pb-20" 
     x-data="{ 
        flipped: false,
        member_type: '{{ $profile->member_type ?? 'student' }}',
        nisn: '{{ $profile->nisn ?? '' }}',
        grade: '{{ $profile->grade ?? '' }}',
        major: '{{ $profile->major ?? '' }}',
        class_num: '{{ $profile->class ?? '' }}',
        position: '{{ $profile->position ?? '' }}',
        name: '{{ $user->name }}',
        
        get cardLabel() {
            return this.member_type === 'osis' ? 'EXECUTIVE BOARD' : 'VERIFIED STUDENT';
        },
        get displayClass() {
            if(this.member_type === 'osis') return this.position || 'Official Member';
            let parts = [];
            if(this.grade) parts.push(this.grade);
            if(this.major) parts.push(this.major);
            if(this.class_num) parts.push(this.class_num);
            return parts.join(' ') || 'WAITING DATA...';
        }
     }">

    <!-- Premium Background Effects -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-primary/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-accent/5 rounded-full blur-[120px] animate-pulse [animation-delay:2s]"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.2] mix-blend-overlay"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 pt-24">
        
        <!-- HEADER SECTION -->
        <div class="mb-20 text-center lg:text-left flex flex-col lg:flex-row lg:items-end justify-between gap-8 animate-fade-in">
            <div>
                <span class="text-[10px] font-black uppercase tracking-[0.6em] text-primary mb-4 block">Identity Hub v4.0</span>
                <h1 class="text-5xl md:text-7xl font-display font-bold text-white uppercase italic tracking-tighter leading-none">
                    E-Identity <span class="text-primary">Studio.</span>
                </h1>
            </div>
            <div class="flex items-center gap-4 justify-center lg:justify-start opacity-40">
                <div class="h-px w-12 bg-white hidden sm:block"></div>
                <p class="text-white text-[10px] font-bold uppercase tracking-widest leading-loose max-w-[200px]">
                    Integrated school system for premium authentication.
                </p>
            </div>
        </div>

        <!-- MAIN STUDIO GRID -->
        <div class="flex flex-col lg:flex-row items-start gap-16 lg:gap-24">
            
            <!-- COLUMN 1: THE CARD (STATIONARY) -->
            <div class="w-full lg:w-[450px] shrink-0 flex flex-col items-center gap-12 lg:sticky lg:top-32 animate-fade-in" style="animation-delay: 200ms">
                
                <!-- CARD 3D ENGINE -->
                <div class="w-full aspect-[1.586/1] perspective-[2000px]">
                    <div 
                        @click="flipped = !flipped"
                        class="relative w-full h-full transition-all duration-[900ms] cubic-bezier(0.19, 1, 0.22, 1) transform-style-3d cursor-pointer group"
                        :class="flipped ? 'rotate-y-180' : ''"
                    >
                        <!-- FRONT SIDE: Liquid Metal Edition -->
                        <div class="absolute inset-0 backface-hidden z-20 shadow-[0_50px_100px_-20px_rgba(0,0,0,1)] rounded-[2.5rem]">
                            <div class="w-full h-full bg-[#111315] rounded-[2.5rem] border border-white/[0.08] p-10 flex flex-col justify-between overflow-hidden relative">
                                <!-- Material Effects & Holographic Sheen -->
                                <div class="absolute inset-0 bg-gradient-to-tr from-white/[0.02] via-transparent to-transparent pointer-events-none"></div>
                                <div class="absolute inset-0 bg-[linear-gradient(115deg,transparent_20%,rgba(255,255,255,0.15)_40%,rgba(230,182,86,0.2)_50%,rgba(255,255,255,0.15)_60%,transparent_80%)] opacity-70 group-hover:opacity-100 transition-opacity pointer-events-none animate-shimmer"></div>
                                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 rounded-full blur-[80px] pointer-events-none"></div>
                                
                                <!-- Header -->
                                <div class="flex justify-between items-start relative z-10">
                                    <div class="font-display font-black text-2xl text-white tracking-tighter uppercase italic leading-none">
                                        SMKN 2 <span :class="member_type === 'osis' ? 'text-accent' : 'text-primary'">ID</span>
                                    </div>
                                    <div class="bg-white/[0.03] border border-white/10 px-4 py-2 rounded-2xl backdrop-blur-xl">
                                        <span class="text-[9px] font-black text-white uppercase tracking-[0.2em]" x-text="cardLabel"></span>
                                    </div>
                                </div>

                                <!-- Photo & Primary Info -->
                                <div class="flex items-center gap-8 relative z-10">
                                    <div class="relative shrink-0">
                                        <div class="w-28 h-28 rounded-full overflow-hidden border-2 border-white/10 bg-slate-900 shadow-2xl p-1 bg-gradient-to-br from-white/10 to-transparent">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=000&color=fff&size=300" class="w-full h-full object-cover rounded-full grayscale brightness-110 contrast-125">
                                        </div>
                                        <div class="absolute -bottom-2 -right-2 w-10 h-10 rounded-full border-4 border-[#111315] flex items-center justify-center shadow-2xl transition-colors duration-500"
                                             :class="member_type === 'osis' ? 'bg-accent' : 'bg-primary'">
                                            <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-2xl font-display font-black text-white uppercase truncate mb-1 tracking-tight" x-text="name"></h3>
                                        <p class="text-[11px] font-mono font-bold text-white/40 tracking-[0.3em] mb-5 uppercase" x-text="nisn || '0000000000'"></p>
                                        
                                        <div class="flex gap-4 border-t border-white/[0.05] pt-5">
                                            <div class="flex-1">
                                                <div class="text-[7px] font-black text-white/20 uppercase tracking-[0.3em] mb-1" x-text="member_type === 'osis' ? 'OFFICIAL ROLE' : 'CLASS ARCHIVE'"></div>
                                                <div class="text-[11px] font-bold text-white uppercase truncate leading-none" x-text="displayClass"></div>
                                            </div>
                                            <div>
                                                <div class="text-[7px] font-black text-white/20 uppercase tracking-[0.3em] mb-1">RANK</div>
                                                <div class="text-[11px] font-black text-white leading-none">LVL {{ $profile->level }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Footer -->
                                <div class="flex justify-between items-end relative z-10">
                                    <div class="space-y-1">
                                        <div class="text-[6px] font-mono text-white/20 uppercase tracking-widest">Digital Authentication System</div>
                                        <div class="text-[9px] font-mono text-white/40 tracking-tighter italic">TX-{{ substr(hash('sha256', $user->email), 0, 12) }}</div>
                                    </div>
                                    <div class="w-14 h-8 bg-gradient-to-br from-white/10 to-transparent rounded-lg border border-white/10 shadow-inner flex items-center justify-center overflow-hidden">
                                        <div class="w-full h-[1px] bg-white/5 -rotate-45"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BACK SIDE: Industrial Scanner -->
                        <div class="absolute inset-0 backface-hidden rotate-y-180 z-10 shadow-[0_50px_100px_-20px_rgba(0,0,0,1)] rounded-[2.5rem]">
                            <div class="w-full h-full bg-[#1a1c1e] rounded-[2.5rem] border border-white/10 p-12 flex flex-col items-center justify-center relative overflow-hidden text-center">
                                <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(230,182,86,0.1),transparent)]"></div>
                                
                                <div class="bg-white p-5 rounded-[2rem] mb-10 transform scale-125 shadow-[0_0_60px_rgba(255,255,255,0.15)] relative z-10">
                                    {!! $qrCode !!}
                                </div>
                                <div class="space-y-4 relative z-10">
                                    <div class="text-[11px] font-black text-accent uppercase tracking-[0.6em]">Scanner Identity</div>
                                    <p class="text-[9px] text-white/30 uppercase font-bold tracking-widest leading-relaxed max-w-[240px] mx-auto">
                                        Verified Identity Key for SMKN 2 Pangkalpinang Digital Ecosystem.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTROLS -->
                <div class="flex flex-col items-center gap-6 w-full">
                    <button @click="flipped = !flipped" 
                            class="w-full py-4 bg-white/5 border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-[0.5em] text-white/60 hover:bg-white/10 hover:text-white transition-all">
                        <span x-show="!flipped">Inspect Flip Side</span>
                        <span x-show="flipped">Return to Front</span>
                    </button>
                    <button onclick="window.print()" 
                            class="w-full py-5 bg-white text-black rounded-2xl text-[10px] font-black uppercase tracking-[0.6em] shadow-[0_20px_40px_rgba(255,255,255,0.1)] hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Generate Identity Hardcopy
                    </button>
                </div>
            </div>

            <!-- COLUMN 2: THE STUDIO CONFIG (WORK AREA) -->
            <div class="flex-1 w-full lg:max-w-3xl animate-fade-in" style="animation-delay: 400ms">
                <div class="bg-[#111315] p-10 md:p-16 rounded-[3.5rem] border border-white/[0.05] shadow-2xl relative overflow-hidden">
                    
                    <div class="relative z-10 mb-16 border-l-8 border-primary pl-8">
                        <h2 class="text-3xl font-display font-black text-white uppercase italic tracking-tighter leading-none mb-4">Core <span class="text-primary">Configuration</span></h2>
                        <p class="text-slate-500 text-sm font-medium tracking-wide">Sync your physical parameters with our digital authentication node.</p>
                    </div>

                    <form action="{{ route('student-id.update') }}" method="POST" class="relative z-10 space-y-16">
                        @csrf @method('PATCH')

                        <!-- TYPE SELECTOR -->
                        <div class="space-y-8">
                            <label class="text-[10px] font-black uppercase tracking-[0.5em] text-slate-500 flex items-center gap-4 uppercase">
                                <span class="w-10 h-px bg-white/10"></span>
                                Membership Architecture
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <label class="cursor-pointer group">
                                    <input type="radio" name="member_type" value="student" x-model="member_type" class="hidden">
                                    <div class="p-8 rounded-[2.5rem] border-2 transition-all duration-500 text-center flex flex-col items-center justify-center gap-2"
                                         :class="member_type === 'student' ? 'bg-primary border-primary text-white shadow-[0_25px_50px_-12px_rgba(31,42,68,0.5)] scale-[1.05]' : 'bg-[#08090a] border-white/5 text-slate-500 group-hover:border-primary/40'">
                                        <div class="text-sm font-black uppercase tracking-widest">Student</div>
                                        <div class="text-[9px] opacity-60 uppercase font-bold tracking-[0.2em] italic leading-none">Verified Access</div>
                                    </div>
                                </label>
                                <label class="cursor-pointer group">
                                    <input type="radio" name="member_type" value="osis" x-model="member_type" class="hidden">
                                    <div class="p-8 rounded-[2.5rem] border-2 transition-all duration-500 text-center flex flex-col items-center justify-center gap-2"
                                         :class="member_type === 'osis' ? 'bg-accent border-accent text-black shadow-[0_25px_50px_-12px_rgba(230,182,86,0.3)] scale-[1.05]' : 'bg-[#08090a] border-white/5 text-slate-500 group-hover:border-accent/40'">
                                        <div class="text-sm font-black uppercase tracking-widest">OSIS Board</div>
                                        <div class="text-[9px] opacity-60 uppercase font-bold tracking-[0.2em] italic leading-none">Executive Rank</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- INPUT GRID -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                            <!-- NISN -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500 ml-4">NISN Identifier</label>
                                <input type="text" name="nisn" x-model="nisn" maxlength="10" placeholder="00XXXXXXXX"
                                       class="w-full bg-[#08090a] border-2 border-white/5 rounded-2xl p-6 text-white text-base font-bold focus:border-primary focus:ring-0 transition-all outline-none shadow-inner">
                            </div>

                            <!-- Grade (Student only) -->
                            <div class="space-y-4" x-show="member_type === 'student'" x-transition:enter="duration-500 ease-out" x-transition:enter-start="opacity-0 translate-x-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500 ml-4">Grade Level</label>
                                <select name="grade" x-model="grade" class="w-full bg-[#08090a] border-2 border-white/5 rounded-2xl p-6 text-white text-base font-bold focus:border-primary outline-none appearance-none cursor-pointer shadow-inner">
                                    <option value="" class="bg-[#08090a]">Select</option>
                                    <option value="X" class="bg-[#08090a]">X (TEN)</option>
                                    <option value="XI" class="bg-[#08090a]">XI (ELEVEN)</option>
                                    <option value="XII" class="bg-[#08090a]">XII (TWELVE)</option>
                                </select>
                            </div>

                            <!-- Major (Student only) -->
                            <div class="space-y-4" x-show="member_type === 'student'" x-transition:enter="duration-500 ease-out" x-transition:enter-start="opacity-0 translate-x-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500 ml-4">Department</label>
                                <select name="major" x-model="major" class="w-full bg-[#08090a] border-2 border-white/5 rounded-2xl p-6 text-white text-base font-bold focus:border-primary outline-none appearance-none cursor-pointer shadow-inner">
                                    <option value="" class="bg-[#08090a]">Choose Major</option>
                                    <option value="TKJ" class="bg-[#08090a]">TKJ - NETWORK</option>
                                    <option value="DKV" class="bg-[#08090a]">DKV - DESIGN</option>
                                    <option value="TKP" class="bg-[#08090a]">TKP - CONST</option>
                                    <option value="RPL" class="bg-[#08090a]">RPL - SOFTWARE</option>
                                </select>
                            </div>

                            <!-- Class Index (Student only) -->
                            <div class="space-y-4" x-show="member_type === 'student'" x-transition:enter="duration-500 ease-out" x-transition:enter-start="opacity-0 translate-x-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-slate-500 ml-4">Class Index</label>
                                <select name="class" x-model="class_num" class="w-full bg-[#08090a] border-2 border-white/5 rounded-2xl p-6 text-white text-base font-bold focus:border-primary outline-none appearance-none cursor-pointer shadow-inner">
                                    <option value="" class="bg-[#08090a]">Select Index</option>
                                    @for($i=1; $i<=5; $i++) <option value="{{ $i }}" class="bg-[#08090a]">{{ $i }}</option> @endfor
                                </select>
                            </div>

                            <!-- OSIS Position (OSIS only) -->
                            <div class="col-span-full space-y-4" x-show="member_type === 'osis'" x-transition:enter="duration-500 ease-out" x-transition:enter-start="opacity-0 translate-y-4">
                                <label class="text-[10px] font-black uppercase tracking-[0.4em] text-accent ml-4">Official Board Position</label>
                                <input type="text" name="position" x-model="position" placeholder="e.g. Chairperson / Secretary"
                                       class="w-full bg-[#08090a] border-2 border-accent/20 rounded-2xl p-6 text-accent text-base font-bold focus:border-accent focus:ring-0 transition-all outline-none shadow-inner">
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="pt-12 border-t border-white/[0.05]">
                            <button type="submit" class="w-full py-7 bg-white text-black rounded-[2rem] font-black text-xs uppercase tracking-[0.8em] hover:bg-accent transition-all shadow-[0_30px_60px_-15px_rgba(255,255,255,0.2)] active:scale-[0.98]">
                                Commit to Digital Core
                            </button>
                        </div>
                    </form>

                    <!-- Background accent inside card -->
                    <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary/10 rounded-full blur-[120px] pointer-events-none"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .perspective { perspective: 2000px; }
    .transform-style-3d { transform-style: preserve-3d; }
    .backface-hidden { backface-visibility: hidden; }
    .rotate-y-180 { transform: rotateY(180deg); }

    [x-cloak] { display: none !important; }

    /* Mandatory White Text Fix */
    input, select, option {
        color: #ffffff !important;
        -webkit-text-fill-color: #ffffff !important;
    }
    
    input::placeholder {
        color: rgba(255,255,255,0.2) !important;
        -webkit-text-fill-color: rgba(255,255,255,0.2) !important;
    }

    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='white'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1.5rem center;
        background-size: 1.2rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @media print {
        header, footer, .lg\:max-w-3xl, .flex.flex-col.items-center.gap-6, .fixed, .mb-20, .animate-bounce { display: none !important; }
        body { background: white !important; }
        .min-h-screen { padding: 0 !important; background: white !important; }
        .max-w-7xl { margin: 0 !important; padding: 0 !important; }
        .backface-hidden { position: static !important; display: block !important; margin: 40px auto !important; width: 500px !important; }
        .rotate-y-180 { transform: none !important; background: #f0f0f0 !important; border: 2px solid black !important; color: black !important; }
        .bg-[#111315] { background: white !important; color: black !important; border: 2px solid black !important; }
        .text-white { color: black !important; }
        .text-primary, .text-accent { color: black !important; font-weight: 900 !important; }
    }
</style>
@endsection
