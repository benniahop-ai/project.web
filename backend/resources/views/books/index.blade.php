@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Daftar Buku</h1>
    <div class="bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($books as $book)
                <tr>
                    <td class="px-4 py-2">
                        <a href="{{ route('books.show', $book) }}" class="text-blue-600 underline">
                            {{ $book->title }}
                        </a>
                    </td>
                    <td class="px-4 py-2">{{ $book->author }}</td>
                    <td class="px-4 py-2">{{ $book->category?->name }}</td>
                    <td class="px-4 py-2">{{ $book->stock }}</td>
                    <td class="px-4 py-2 text-right">
                        @auth
                            @if($book->stock > 0)
                                <form action="{{ route('loans.store', $book) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Pinjam</button>
                                </form>
                            @else
                                <span class="text-red-600 text-sm">Habis</span>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $books->links() }}
    </div>
@endsection

