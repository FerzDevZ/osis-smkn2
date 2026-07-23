@extends('layouts.app')

@section('title', 'Moderasi Menfess')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-20">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <div>
            <h1 class="font-display font-bold text-3xl text-primary">Moderasi Menfess</h1>
            <p class="text-text-muted text-sm">Kelola pesan yang masuk dari siswa.</p>
        </div>
        <a href="{{ route('menfess.index') }}" class="text-xs font-bold bg-white/50 px-4 py-2 rounded-full border hover:bg-white transition">Lihat Halaman Publik</a>
    </div>

    <div class="glass overflow-hidden rounded-3xl border-white/20 shadow-xl">
        <table class="w-full text-sm text-left">
            <thead class="bg-primary/5 text-primary text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Pesan</th>
                    <th class="px-6 py-4">Pengirim</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-black/5">
                @foreach($messages as $msg)
                    <tr class="hover:bg-white/40 transition">
                        <td class="px-6 py-4 font-mono text-xs">#{{ $msg->id }}</td>
                        <td class="px-6 py-4">
                            <div class="max-w-md line-clamp-2 italic text-text">{{ $msg->content }}</div>
                            <div class="text-[10px] text-text-muted mt-1">{{ $msg->created_at->format('d M Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($msg->sender)
                                <div class="text-xs font-bold">{{ $msg->sender->name }}</div>
                                <div class="text-[10px] text-text-muted">{{ $msg->sender->email }}</div>
                            @else
                                <span class="text-text-muted italic text-xs">Anonim</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($msg->is_approved)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold">PUBLISHED</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-[10px] font-bold">PENDING</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <form action="{{ route('admin.menfess.toggle', $msg) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-xs font-bold {{ $msg->is_approved ? 'text-orange-600' : 'text-green-600' }} hover:underline">
                                    {{ $msg->is_approved ? 'Unpublish' : 'Approve' }}
                                </button>
                            </form>
                            <form action="{{ route('admin.menfess.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8">
        {{ $messages->links() }}
    </div>
</div>
@endsection
