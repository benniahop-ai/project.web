@extends('layouts.app')

@section('content')
    <style>
        .admin-dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.75rem;
        }

        .admin-dashboard-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .admin-dashboard-subtitle {
            margin-top: 0.25rem;
            color: #6b7280;
            font-size: 0.98rem;
        }

        .admin-dashboard-user {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background-color: #eff6ff;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
        }

        .admin-dashboard-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #ffffff;
            font-weight: 600;
        }

        .admin-dashboard-user-name {
            font-size: 0.95rem;
            font-weight: 600;
        }

        .admin-dashboard-user-role {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .admin-dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2rem;
        }

        .admin-stat-card {
            padding: 1.2rem 1.4rem;
            border-radius: 0.9rem;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.18);
            color: #0f172a;
        }

        .admin-stat-title {
            font-size: 0.9rem;
            color: #334155;
            margin-bottom: 0.2rem;
        }

        .admin-stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .admin-stat-caption {
            font-size: 0.8rem;
            color: #475569;
        }

        .admin-stat-indigo {
            background: linear-gradient(135deg, #eef2ff, #c4b5fd);
        }

        .admin-stat-teal {
            background: linear-gradient(135deg, #ccfbf1, #6ee7b7);
        }

        .admin-stat-amber {
            background: linear-gradient(135deg, #fef3c7, #facc15);
        }

        .admin-stat-rose {
            background: linear-gradient(135deg, #ffe4e6, #f9a8d4);
        }

        .admin-dashboard-main {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(0, 1.4fr);
            gap: 1.75rem;
            align-items: flex-start;
        }

        @media (max-width: 900px) {
            .admin-dashboard-main {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        .admin-panel {
            background-color: #f9fafb;
            border-radius: 0.9rem;
            padding: 1.25rem 1.4rem;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.12);
        }

        .admin-panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .admin-panel-title {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
        }

        .admin-panel-link {
            font-size: 0.85rem;
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .admin-panel-link:hover {
            text-decoration: underline;
        }

        .admin-transaction-list {
            display: grid;
            gap: 0.65rem;
        }

        .admin-transaction-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 0.75rem;
            align-items: center;
            padding: 0.55rem 0.7rem;
            border-radius: 0.65rem;
            background-color: #ffffff;
        }

        .admin-transaction-avatar {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e0f2fe;
            color: #0ea5e9;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .admin-transaction-name {
            font-size: 0.92rem;
            font-weight: 600;
            color: #0f172a;
        }

        .admin-transaction-book {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .admin-transaction-meta {
            font-size: 0.78rem;
            color: #6b7280;
        }

        .admin-status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.18rem 0.65rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .admin-status-borrowed {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .admin-status-returned {
            background-color: #dcfce7;
            color: #15803d;
        }

        .admin-quick-actions {
            display: grid;
            gap: 0.55rem;
            margin-bottom: 1.2rem;
        }

        .admin-quick-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.7rem 0.8rem;
            border-radius: 0.7rem;
            background-color: #ffffff;
            text-decoration: none;
            color: #0f172a;
            font-size: 0.9rem;
        }

        .admin-quick-action-label {
            font-weight: 500;
        }

        .admin-quick-action-icon {
            font-size: 1rem;
            color: #9ca3af;
        }

        .admin-overview-list {
            margin-top: 0.6rem;
            font-size: 0.9rem;
            color: #111827;
        }

        .admin-overview-row {
            display: flex;
            justify-content: space-between;
            padding: 0.25rem 0;
        }

        .admin-overview-label {
            color: #6b7280;
        }

        .admin-overview-value {
            font-weight: 600;
        }
    </style>

    <div class="admin-dashboard-header">
        <div>
            <div class="admin-dashboard-title">Dashboard Admin</div>
            <div class="admin-dashboard-subtitle">Ringkasan singkat apa yang terjadi di perpustakaan kamu.</div>
        </div>
        <div class="admin-dashboard-user">
            <div class="admin-dashboard-user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="admin-dashboard-user-name">{{ auth()->user()->name }}</div>
                <div class="admin-dashboard-user-role">Admin</div>
            </div>
        </div>
    </div>

    <div class="admin-dashboard-stats">
        <div class="admin-stat-card admin-stat-indigo">
            <div class="admin-stat-title">Total Buku</div>
            <div class="admin-stat-value">{{ $totalBooks }}</div>
            <div class="admin-stat-caption">Semua koleksi yang tersedia.</div>
        </div>
        <div class="admin-stat-card admin-stat-teal">
            <div class="admin-stat-title">Peminjaman Aktif</div>
            <div class="admin-stat-value">{{ $activeLoans }}</div>
            <div class="admin-stat-caption">Sedang dipinjam dan belum dikembalikan.</div>
        </div>
        <div class="admin-stat-card admin-stat-rose">
            <div class="admin-stat-title">Total Transaksi</div>
            <div class="admin-stat-value">{{ $totalLoans }}</div>
            <div class="admin-stat-caption">Riwayat pinjam dan pengembalian.</div>
        </div>
        <div class="admin-stat-card admin-stat-amber">
            <div class="admin-stat-title">Sudah Dikembalikan</div>
            <div class="admin-stat-value">{{ $returnedLoans }}</div>
            <div class="admin-stat-caption">Transaksi yang telah selesai.</div>
        </div>
    </div>

    <div class="admin-dashboard-main">
        <div class="admin-panel">
            <div class="admin-panel-header">
                <div class="admin-panel-title">Transaksi Terbaru</div>
                <a href="{{ route('loans.index') }}" class="admin-panel-link">Lihat peminjaman saya</a>
            </div>

            @if($recentLoans->isEmpty())
                <p class="admin-transaction-meta">Belum ada transaksi peminjaman.</p>
            @else
                <div class="admin-transaction-list">
                    @foreach($recentLoans as $loan)
                        <div class="admin-transaction-item">
                            <div class="admin-transaction-avatar">
                                {{ strtoupper(substr($loan->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="admin-transaction-name">{{ $loan->user->name ?? 'User' }}</div>
                                <div class="admin-transaction-book">{{ $loan->book->title ?? 'Buku' }}</div>
                                <div class="admin-transaction-meta">
                                    {{ $loan->borrow_date?->format('d/m/Y') }}
                                    @if($loan->status === 'RETURNED' && $loan->return_date)
                                        • dikembalikan {{ $loan->return_date->format('d/m/Y') }}
                                    @endif
                                </div>
                            </div>
                            <div>
                                @if($loan->status === 'BORROWED')
                                    <span class="admin-status-pill admin-status-borrowed">BORROWED</span>
                                @else
                                    <span class="admin-status-pill admin-status-returned">RETURNED</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="admin-panel">
            <div class="admin-panel-header">
                <div class="admin-panel-title">Aksi Cepat</div>
            </div>

            <div class="admin-quick-actions">
                <a href="{{ route('admin.books.create') }}" class="admin-quick-action">
                    <span class="admin-quick-action-label">Tambah Buku Baru</span>
                    <span class="admin-quick-action-icon">➜</span>
                </a>
                <a href="{{ route('admin.books.index') }}" class="admin-quick-action">
                    <span class="admin-quick-action-label">Kelola Daftar Buku</span>
                    <span class="admin-quick-action-icon">➜</span>
                </a>
                <a href="{{ route('books.index') }}" class="admin-quick-action">
                    <span class="admin-quick-action-label">Lihat Tampilan Pengguna</span>
                    <span class="admin-quick-action-icon">➜</span>
                </a>
            </div>

            <div class="admin-panel-header" style="margin-top: 0.4rem;">
                <div class="admin-panel-title">Ringkasan Perpustakaan</div>
            </div>
            <div class="admin-overview-list">
                <div class="admin-overview-row">
                    <span class="admin-overview-label">Total Kategori</span>
                    <span class="admin-overview-value">{{ $totalCategories }}</span>
                </div>
                <div class="admin-overview-row">
                    <span class="admin-overview-label">Total Pengguna</span>
                    <span class="admin-overview-value">{{ $totalUsers }}</span>
                </div>
                <div class="admin-overview-row">
                    <span class="admin-overview-label">Total Buku</span>
                    <span class="admin-overview-value">{{ $totalBooks }}</span>
                </div>
                <div class="admin-overview-row">
                    <span class="admin-overview-label">Peminjaman Aktif</span>
                    <span class="admin-overview-value">{{ $activeLoans }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
