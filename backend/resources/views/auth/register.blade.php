@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1 class="form-section-title">Register</h1>
        <p class="form-section-subtitle">Daftar untuk mulai meminjam buku.</p>

        <form method="POST" action="{{ route('register.post') }}" class="form-grid">
            @csrf
            <div>
                <label class="form-label">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
    </div>
@endsection
