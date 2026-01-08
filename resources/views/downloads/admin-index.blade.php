@extends('layouts.app')
@section('title', 'Kelola File - Admin')
@section('content')

<div class="py-24 px-4 bg-white/30 dark:bg-neutral-900/10">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-12">
            <h1 class="text-3xl font-bold dark:text-white">Kelola Pusat Unduhan</h1>
            <a href="{{ route('admin.downloads.create') }}" class="bg-primary text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                + Upload File
            </a>
        </div>

        <div class="glass overflow-hidden rounded-[2rem] border border-white/20 shadow-xl">
            <table class="w-full text-left">
                <thead class="bg-primary/5 dark:bg-white/5 border-b border-black/5 dark:border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60">File</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60">Category</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60 text-center">Downloads</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest dark:text-white/60 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5 dark:divide-white/5">
                    @foreach($downloads as $d)
                        <tr class="hover:bg-black/[0.02] dark:hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <span class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-[10px]">{{ strtoupper($d->file_type) }}</span>
                                    <span class="font-bold dark:text-white text-sm">{{ $d->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm dark:text-white/70">{{ $d->category }}</td>
                            <td class="px-6 py-4 text-sm dark:text-white/70 text-center font-bold">{{ $d->download_count }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.downloads.edit', $d) }}" class="p-2 rounded-lg bg-white/50 dark:bg-white/5 hover:bg-white transition">✏️</a>
                                    <form action="{{ route('admin.downloads.destroy', $d) }}" method="POST" onsubmit="return confirm('Hapus file ini?')">
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
            {{ $downloads->links() }}
        </div>
    </div>
</div>

@endsection
