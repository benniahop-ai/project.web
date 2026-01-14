@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">{{ $book->title }}</h1>
    <div class="bg-white rounded shadow p-4 mb-4">
        <p>Penulis: {{ $book->author }}</p>
        <p>Tahun: {{ $book->year }}</p>
        <p>Kategori: {{ $book->category?->name }}</p>
        <p>Stock: {{ $book->stock }}</p>
    </div>
    @auth
        @if($book->stock > 0)
            <form action="{{ route('loans.store', $book) }}" method="POST" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Pinjam Buku</button>
            </form>
        @else
            <p class="text-red-600 mb-4">Stock buku habis.</p>
        @endif
    @endauth
    <a href="{{ route('books.index') }}" class="text-blue-600 underline">Kembali ke daftar buku</a>
@endsection

