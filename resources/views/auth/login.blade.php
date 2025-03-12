@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="forms">
        <div class="form login">
            <span class="title">Zule Store</span>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-field">
                    <input type="email" name="email" placeholder="Introduce tu correo electrónico" 
                        class="@error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" required autocomplete="email" autofocus />
                    <i class="uil uil-envelope icon"></i>
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password" placeholder="Introduce tu contraseña" 
                        class="@error('password') is-invalid @enderror" 
                        required autocomplete="current-password" />
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                    @error('password')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" name="remember" id="logCheck" {{ old('remember') ? 'checked' : '' }} />
                        <label for="logCheck" class="text">Recuérdame</label>
                    </div>

                    <a href="{{ route('password.request') }}" class="text">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="input-field button">
                    <input type="submit" value="Iniciar Sesión" />
                </div>
            </form>

            {{-- <div class="login-signup">
                <span class="text">
                    ¿No eres miembro?
                    <a href="{{ route('register') }}" class="text signup-link">Regístrate ahora</a>
                </span>
            </div> --}}
        </div>
    </div>
</div>

@endsection
