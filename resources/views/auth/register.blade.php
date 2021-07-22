@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>
    .bg-fucsia {
        background: transparent linear-gradient(0deg, #13192E 0%, #13192E 100%) 0% 0% no-repeat padding-box;

    }

    .text-rosado {
        color: #12531d;
    }

    .bg-full-screen-image-alt {
        background: url("{{asset('assets/img/sistema/fondo-iniciar-sesion-binari.png')}}") !important;

    }

    .btn-login {
        padding: 0.6rem 2rem;
        border-radius: 1.429rem;
    }

    .text-input-holder {
        font-weight: 800;
        color: #000000;
    }

    .card {
        border-radius: 4px;
        width: 417px;
        height: 590px;
        left: -50px;
        top: 16px;
        background: #011E0C;
    }

    .terminos{
    color: #00BE54;
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size .3s;
}

.terminos:hover, :focus{
    color:#00ff73;
    background-size: 100% 2px;
}

.iniciasesion{
    color: #00BE54;
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size .3s;
}

.iniciasesion:hover, :focus{
    color:#00ff73;
    background-size: 100% 2px;
}

.btn-registro{
        width: 375px;
        height: 51px;
        border: 1px solid #00461B;
        box-sizing: border-box;
        border-radius: 5px;
   }

   .inputransparente {
    background-color: #011E0C;
    border: 1px solid #00461B;
    box-sizing: border-box;
    border-radius: 5px;

}

.inputransparente:focus-within {
    background-color: #011E0C;
    border: 1px solid #00461B;
    box-sizing: border-box;
    border-radius: 5px;

}
.inputransparente::placeholder { color: rgb(168, 167, 167); font-weight: bold; }
</style>
@endpush

@php
$referred = null;
@endphp
@if ( request()->referred_id != null )
@php
$referred = DB::table('users')
->select('fullname')
->where('ID', '=', request()->referred_id)
->first();
@endphp
@endif


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8 col-12">
            {{-- header --}}

            {{-- cuerpo register --}}
            <div class="card mb-0 card-margin">
                <div class="card-header">

                    @if (!empty($referred))
                    <h6 class="text-center col-12">Registro Referido por {{$referred->fullname}}</h6>
                    @endif
                </div>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body">
                    <div class="col-12 text-center logobinari">
                        <img src="{{asset('assets/img/BINARYTARGET-white.png')}}" class="mb-2" alt="logo" height="80" width="130">
                    </div>

                    <h5 class="card-title text-left text-white col-12 text-input-holder">{{ __('Registrar') }}</h5>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- campo referido --}}
                        @if ( request()->referred_id != null )
                        <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
                        @else
                        <input type="hidden" name="referred_id" value="1">
                        @endif

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control  inputransparente text-white @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Nombre y Apellido">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control inputransparente text-white @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Correo Electronico">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email_confirmation" type="email_confirmation" class=" inputransparente text-white form-control @error('email_confirmation') is-invalid @enderror"
                                    name="email_confirmation" value="{{ old('email_confirmation') }}" required autocomplete="email"
                                    placeholder="Confirmar Correo Electronico">

                                @error('email_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control inputransparente text-white @error('password') is-invalid  @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Ingrese una contraseña">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control inputransparente text-white"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="confirme su contraseña">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-registro text-white btn-block btn-login">
                                    {{ __('Registrarme') }}
                                </button>
                            </div>
                        </div>

                        <fieldset class="checkbox mt-1 ml-2">
                            <div class="vs-checkbox-con vs-checkbox-primary float-left justify-content-center">
                                <input type="checkbox" name="term" id="term" {{ old('term') ? 'checked' : '' }}>
                                <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                                @error('term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <span class="">Acepto los <a class="terminos" href="{{-- {{ route('term') }} --}}">Terminos y
                                    Condiciones</a></span>
                        </fieldset>

                    </form>
                    <div class="col-12">
                        <p class="text-center">
                            <small>
                                <span>¿Ya tienes una cuenta?</span>

                                <a class="iniciasesion" href="{{ route('login') }}">
                                    {{ __('Inicia sesión') }}
                                </a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
