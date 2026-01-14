@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <h1 class="form-section-title">Login</h1>
        <p class="form-section-subtitle">Masuk untuk mengakses perpustakaan.</p>
        
        <form method="POST" action="{{ route('login.post') }}" class="form-grid">
            @csrf
            <div>
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>
            <div class="form-remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>
    </div>
@endsection
