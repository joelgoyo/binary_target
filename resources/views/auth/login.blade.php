@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>
    .logobinari{
     position: absolute;
     z-index: 2;
     top: 90px;
     left: 60px;

}
.logotexto{
    position: absolute;
     top: 200px;
     left: -53px;

     z-index: 2;

}


.olvideContraseña{
    position: absolute;
     top: 320px;
     left: 300px;
     color: #00BE54;
     font-size: 15px;
     z-index: 2;
}

.olvideContraseña:hover{
    color: #05ff2e;
}

.registratelink:hover{
    color: #05ff2e;
}

.registrate{
    position: absolute;
     top: -50px;
     left: 30px;
     color: #ffffff;
     font-size: 20px;
     left: 10px;
     z-index: 2;

}
.registratelink{
    color: #00BE54;

}

.iniciarsesion{
    position: absolute;
     top: 170px;
     left: 1px;

     z-index: 2;

}
    .bg-fucsia {
        top: 600px;
    }

    .text-rosado {
        color: #ffffff;
        top: 100px


    }

    .btn-login {
       position: absolute;
       width: 416px;
       height: 51px;
       top: 450px;
       left: 30px;
       border: 1px solid #00461B;
       box-sizing: border-box;
       border-radius: 5px;
       font-weight: 600;
       font-size: 18px;
       font-style: normal;
    }

    .text-input-holder {
        font-weight: 800;


    }

    .card{
        position: relative;
        z-index: 1;
        border-radius: 4px;
        width: 487px;
        height: 701px;
        left: -90px;
        top: 16px;
        background: #011E0C;
    }

    .inputcorreo{
        position: absolute;
        top: 250px;
        left: 30px;
        width: 415px;
        height: 50px;
        border: 1px solid #00461B;
        box-sizing: border-box;
        border-radius: 5px;
        z-index: 60px;
        background-color:transparent;
        background: inherit;

    }
    .inputcontraseña{
        position: absolute;
   top: 350px;
   left: 30px;
   width: 415px;
   z-index: 6px;

   height: 50px;
   }



</style>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8 col-12">
            {{-- header --}}
            <div class="col-12 text-center ">
                <img src="{{asset('assets/img/BINARYTARGET-white.png')}}" alt="logo" height="100" width="150" class="logobinari">
                <h5 class="text-white "></h5>
            </div>
            {{-- cuerpo login --}}
            <div class="card mb-1 card-margin">
                <div class="card-header iniciarsesion">
                    <h5 class="text-white card-title text-center col-12 text-input-holder">{{ __('Iniciar Sesión') }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="email" type="email"
                                    class="inputcorreo form-control text-input-holder @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Ingresa tu email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="inputcontraseña form-control text-input-holder @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="Ingresa tu contraseña">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @if (Route::has('password.request'))
                                <a class=" olvideContraseña" href="{{ route('password.request') }}">
                                    {{ __('Olvidé mi contraseña') }}
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn bg-fucsia text-white btn-block btn-login">
                                    {{ __('Ingresar') }}
                                </button>
                            </div>
                        </div>

                        <fieldset class="checkbox  mt-1">
                            <div class="vs-checkbox-con vs-checkbox-danger justify-content-center">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="vs-checkbox ">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                </span>
                                <span class="">Recordar</span>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <p class="text-center registrate ">
                    <small >
                        <span>¿Aun no tienes una cuenta?</span>

                        <a class="registratelink" href="{{ route('register') }}">
                            {{ __('Registrate') }}
                        </a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
