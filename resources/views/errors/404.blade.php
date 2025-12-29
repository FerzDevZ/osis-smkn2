@extends('layouts.app')
@section('title','Halaman tidak ditemukan')
@section('content')

  <section class="max-w-3xl mx-auto px-4 py-24 text-center">
    <div class="text-7xl font-bold text-primary">404</div>
    <h1 class="mt-4 text-2xl font-semibold">Halaman tidak ditemukan</h1>
    <p class="mt-2 text-gray-600">Maaf, halaman yang Anda cari tidak tersedia.</p>
    <div class="mt-6">
      <a href="{{ route('home') }}" class="bg-primary text-white px-4 py-2 rounded">Kembali ke Beranda</a>
    </div>
  </section>

@endsection


