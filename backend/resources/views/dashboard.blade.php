@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Dashboard User</h1>
    <p class="mb-4">Selamat datang, {{ auth()->user()->name }}.</p>
    <p class="mb-2">Peminjaman aktif: {{ $activeLoans }}</p>
    <a href="{{ route('books.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">Lihat Daftar Buku</a>
@endsection

