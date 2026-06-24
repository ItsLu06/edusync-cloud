@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <div class="card" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 2rem;">
                <div class="text-center mb-4">
                    <h2 style="font-size: 2rem; font-weight: 700; color: var(--accent-color); text-shadow: 0 0 30px var(--glow-color);">EduSync</h2>
                    <p style="color: #b0b0b0;">Crea tu cuenta gratis</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" style="color: #e0e0e0;">Nombre completo</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" style="color: #e0e0e0;">Correo electrónico</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" style="color: #e0e0e0;">Contraseña</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" style="color: #e0e0e0;">Confirmar contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e0e0e0; border-radius: 10px; padding: 12px;">
                    </div>

                    <button type="submit" class="btn w-100" style="padding: 12px; border-radius: 30px; font-weight: 600; background: var(--accent-color); color: #0d0d0d; border: none; box-shadow: 0 0 30px var(--glow-color);">
                        Registrarse
                    </button>

                    <div class="text-center mt-3">
                        <p style="color: #b0b0b0;">¿Ya tienes cuenta? <a href="{{ route('login') }}" style="color: var(--accent-color); text-decoration: none; font-weight: 600;">Inicia sesión</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection