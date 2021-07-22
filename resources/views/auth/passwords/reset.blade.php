@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>
    .bg-fucsia {
        background: transparent linear-gradient(0deg, #13192E 0%, #13192E 100%) 0% 0% no-repeat padding-box;

    }

    .text-rosado {
        color: #13192E;
    }

    .bg-full-screen-image-alt {
        background: url("{{asset('assets/img/sistema/fondo-registro.png')}}") !important;
        background-size: 100% 60% !important;
        background-repeat: no-repeat !important;
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
        border-radius: 1.5rem;
    }

</style>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8 col-12">
            {{-- header --}}
            <div class="col-12 text-center mb-2">
                <img src="{{asset('assets/img/BINARYTARGET-white.png')}}" alt="logo" height="150" width="190">
                <h5 class="text-white">Bienvenido a BINARY TARGET</h5>
            </div>
            {{-- cuerpo login --}}
            <div class="card card-margin">
                <div class="card-header text-center">
                    <a class="text-rosado float-left" href="{{route('login')}}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                    <h5 class="card-title col-11 text-input-holder">{{ __('Reset Password') }}</h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required placeholder="Correo Electronico" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Ingrese una contraseña" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="confirme su contraseña" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn bg-fucsia btn-login text-white btn-block waves-effect waves-light">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
