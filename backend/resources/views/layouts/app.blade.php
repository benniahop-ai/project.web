<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan Mini</title>
    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: radial-gradient(circle at top, #e0f2fe, #f3f4f6 45%, #e5e7eb);
            color: #111827;
        }

        nav {
            background-color: #2563eb;
            color: #ffffff;
            padding: 0.9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25);
        }

        nav a {
            color: #ffffff;
            margin-right: 1rem;
            text-decoration: none;
            font-weight: 500;
        }

        nav a:last-child {
            margin-right: 0;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            max-width: 1200px;
            margin: 2.2rem auto;
            padding: 2.4rem 2.8rem;
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.18);
        }

        h1 {
            font-size: 2.1rem;
            margin-bottom: 1rem;
        }

        .flash-success,
        .flash-error {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .flash-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .flash-error {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 999px;
            padding: 0.55rem 1.2rem;
            font-size: 0.98rem;
            cursor: pointer;
            font-weight: 600;
            transition: transform 0.08s ease, box-shadow 0.1s ease, background-color 0.1s ease;
        }

        .btn-primary {
            background: linear-gradient(to right, #2563eb, #4f46e5);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.5);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, 0.6);
        }

        .btn-warning {
            background-color: #facc15;
            color: #1f2933;
        }

        .btn-danger {
            background-color: #dc2626;
            color: #ffffff;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        table th,
        table td {
            border: 1px solid #e5e7eb;
            padding: 0.55rem 0.85rem;
            text-align: left;
        }

        table th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151;
        }

        table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        table tr:hover {
            background-color: #eef2ff;
        }

        .link-primary {
            color: #2563eb;
            text-decoration: none;
        }

        .link-primary:hover {
            text-decoration: underline;
        }

        .auth-container {
            max-width: 460px;
            margin: 0 auto;
        }

        .form-section-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .form-section-subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-bottom: 1.3rem;
        }

        .form-grid {
            display: grid;
            gap: 0.9rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            color: #111827;
            margin-bottom: 0.3rem;
        }

        .form-input {
            width: 100%;
            border-radius: 0.6rem;
            border: 1px solid #d1d5db;
            padding: 0.65rem 0.85rem;
            font-size: 1rem;
        }

        .form-input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 1px #2563eb33;
        }

        .form-remember {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.92rem;
            color: #4b5563;
            margin-top: 0.1rem;
        }

        .btn-block {
            width: 100%;
        }
    </style>
    </style>
</head>
<body>
    <nav>
        <div>
            <a href="{{ route('dashboard') }}">Perpustakaan Mini</a>
        </div>
        <div>
            @auth
                <a href="{{ route('books.index') }}">Daftar Buku</a>
                <a href="{{ route('loans.index') }}">Peminjaman Saya</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.books.index') }}">Kelola Buku</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn" style="background-color: #ffffff; color: #2563eb;">Logout</button>
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endguest
        </div>
    </nav>
    <main>
        @if(session('success'))
            <div class="flash-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash-error">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
