@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            <div class="card" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 2rem;">
                <div class="text-center mb-4">
                    <h2 style="font-size: 2rem; font-weight: 700; color: var(--accent-color); text-shadow: 0 0 30px var(--glow-color);">EduSync</h2>
                    <p style="color: #b0b0b0;">Inicia sesión para continuar</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" style="color: #e0e0e0;">Correo electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" style="color: #e0e0e0;">Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember" style="color: #b0b0b0;">Recordarme</label>
                    </div>

                    <button type="submit" class="btn w-100" style="padding: 12px; border-radius: 30px; font-weight: 600; background: var(--accent-color); color: #0d0d0d; border: none; box-shadow: 0 0 30px var(--glow-color);">
                        Iniciar sesión
                    </button>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" style="color: #b0b0b0; text-decoration: none;">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif

                    <div class="text-center mt-3">
                        <p style="color: #b0b0b0;">¿No tienes cuenta? <a href="{{ route('register') }}" style="color: var(--accent-color); text-decoration: none; font-weight: 600;">Regístrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection