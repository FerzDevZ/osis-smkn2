@extends('layouts.app')
@section('title', 'Kelola Struktur - Admin')
@section('content')

<div class="py-24 px-4 bg-white/30 dark:bg-neutral-900/10">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <h1 class="text-3xl font-bold dark:text-white">Kelola Struktur Organisasi</h1>
            <a href="{{ route('admin.members.create') }}" class="bg-primary text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                + Tambah Anggota
            </a>
        </div>

        <div class="glass overflow-hidden rounded-[2rem] border border-white/20 shadow-xl">
            <table class="w-full text-left">
                <thead class="bg-primary/5 dark:bg-white/5 border-b border-black/5 dark:border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60">Anggota</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60">Position</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60">Department</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @foreach($members as $m)
                        <tr class="hover:bg-black/[0.02] dark:hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl overflow-hidden bg-white/50 border border-black/5 shadow-sm">
                                    <img src="{{ $m->photo_path ? Storage::url($m->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($m->name) }}" class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold dark:text-white text-sm">{{ $m->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm dark:text-white/70">{{ $m->position }}</td>
                            <td class="px-6 py-4 text-sm dark:text-white/70">{{ $m->department }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.members.edit', $m) }}" class="p-2 rounded-lg bg-white/50 dark:bg-white/5 hover:bg-white transition">✏️</a>
                                    <form action="{{ route('admin.members.destroy', $m) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition">🗑️</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $members->links() }}
        </div>
    </div>
</div>

@endsection
