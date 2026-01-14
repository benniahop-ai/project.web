@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Peminjaman Saya</h1>
    <div class="bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-2"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($loans as $loan)
                <tr>
                    <td class="px-4 py-2">{{ $loan->book?->title }}</td>
                    <td class="px-4 py-2">{{ $loan->borrow_date->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">{{ $loan->return_deadline->format('d-m-Y') }}</td>
                    <td class="px-4 py-2">
                        @if($loan->status === 'BORROWED')
                            <span class="text-yellow-700">BORROWED</span>
                        @else
                            <span class="text-green-700">RETURNED</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 text-right">
                        @if($loan->status === 'BORROWED')
                            <form action="{{ route('loans.return', $loan) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada peminjaman.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

