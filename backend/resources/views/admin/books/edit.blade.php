@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Edit Buku</h1>
    <form action="{{ route('admin.books.update', $book) }}" method="POST" class="space-y-4 max-w-lg">
        @csrf
        @method('PUT')
        <div>
            <label class="block mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Penulis</label>
            <input type="text" name="author" value="{{ old('author', $book->author) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Tahun</label>
            <input type="number" name="year" value="{{ old('year', $book->year) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label class="block mb-1">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection

