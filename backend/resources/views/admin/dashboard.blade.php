@extends('layouts.app')

@section('content')
    <h1>Dashboard Admin</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
        <div style="background: #eff6ff; padding: 1rem 1.2rem; border-radius: 0.75rem;">
            <p style="color: #4b5563; margin-bottom: 0.25rem;">Total Buku</p>
            <p style="font-size: 1.6rem; font-weight: 700;">{{ $totalBooks }}</p>
        </div>
        <div style="background: #ecfeff; padding: 1rem 1.2rem; border-radius: 0.75rem;">
            <p style="color: #4b5563; margin-bottom: 0.25rem;">Total Transaksi</p>
            <p style="font-size: 1.6rem; font-weight: 700;">{{ $totalLoans }}</p>
        </div>
        <div style="background: #fef9c3; padding: 1rem 1.2rem; border-radius: 0.75rem;">
            <p style="color: #4b5563; margin-bottom: 0.25rem;">Peminjaman Aktif</p>
            <p style="font-size: 1.6rem; font-weight: 700;">{{ $activeLoans }}</p>
        </div>
    </div>
    <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Kelola Buku</a>
@endsection
