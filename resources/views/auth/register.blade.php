@extends('layouts.app')

@section('content')
<div class="container">
    <div class="forms">
        <div class="form register">
            <span class="title">Registro</span>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-field">
                    <input id="first_name" type="text" placeholder="Ingrese su nombre" 
                        class="@error('first_name') is-invalid @enderror" 
                        name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus />
                    <i class="uil uil-user icon"></i>
                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="last_name" type="text" placeholder="Ingrese sus apellidos" 
                        class="@error('last_name') is-invalid @enderror" 
                        name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" />
                    <i class="uil uil-user icon"></i>
                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="email" type="email" placeholder="Ingrese su correo electrónico" 
                        class="@error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}" required autocomplete="email" />
                    <i class="uil uil-envelope icon"></i>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="password" type="password" placeholder="Cree una contraseña" 
                        class="@error('password') is-invalid @enderror" 
                        name="password" required autocomplete="new-password" />
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="password-confirm" type="password" placeholder="Confirme su contraseña" 
                        name="password_confirmation" required autocomplete="new-password" />
                    <i class="uil uil-lock icon"></i>
                </div>

                {{-- <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" required>
                        <label class="text">Acepto todos los términos y condiciones</label>
                    </div>
                </div> --}}

                <div class="input-field button">
                    <input type="submit" value="Registrarse ahora" />
                </div>
            </form>

            <div class="login-signup">
                <span class="text">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text signup-link">Inicia sesión</a>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection
