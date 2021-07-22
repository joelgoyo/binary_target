@extends('layouts.auth')

@section('content')
@push('custom_css')
<style>




    .card{


        border-radius: 4px;
        width: 417px;
        height: 551px;
        left: -50px;
        top: 16px;
        background: #011E0C;
    }

    .btn-ingresar{
        width: 375px;
        height: 51px;
        border: 1px solid #00461B;
        box-sizing: border-box;
        border-radius: 5px;
   }



.olvidecontraseña{
    color: #00BE54;
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size .3s;
}

.olvidecontraseña:hover, :focus{
    color:#00ff73;
    background-size: 100% 2px;
}

.color{
    color: #00BE54;
    text-decoration: none;
    background-image: linear-gradient(currentColor, currentColor);
    background-position: 0% 100%;
    background-repeat: no-repeat;
    background-size: 0% 2px;
    transition: background-size .3s;
}
.color:hover{
    color: #00ff73;
    background-size: 100% 2px;

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


input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active
{
 -webkit-box-shadow: 0 0 0 30px #011E0C inset !important;
 -webkit-text-fill-color: rgb(255, 255, 255) !important;
}
.inputransparente::placeholder { color: rgb(168, 167, 167); font-weight: bold; }

</style>
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8 col-12">
            {{-- header --}}

            {{-- cuerpo login --}}
            <div class="card mb-1 card-margin">
                <div class="card-header iniciarsesion">

                </div>

                <div class="card-body">

                    <div class="col-12 text-center logobinari">
                        <img src="{{asset('assets/img/BINARYTARGET-white.png')}}" class="mb-2" alt="logo" height="80" width="130">
                    </div>

                    <div class="text-left">
                        <h5 class="text-white card-title   ">{{ __('Iniciar Sesión') }}
                        </h5>
                         </div>
                      <h6 class="text-white" >
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent non sapien non nunc
                         ultricies varius eu vel sem.
                      </h6>
                      <br>
                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-12">
                                 <h6 class="text-white"> Usuario </h6>
                                <input id="email" type="email"
                                    class=" inputransparente text-white form-control  @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Ingrese usuario o email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                      <div class="text-right  ">
                        @if (Route::has('password.request'))
                        <a class="text-right olvidecontraseña" href="{{ route('password.request') }}">
                            {{ __('Olvidé mi contraseña') }}
                        </a>
                        @endif
                      </div>
                      <h6 class="text-white"> Contraseña </h6>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class=" inputransparente form-control text-white  @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    placeholder="Contraseña">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div class="">
                                <fieldset class="checkbox  mt-1">
                                    <div class="vs-checkbox-con vs-checkbox-danger ">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="vs-checkbox ">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                        <span class="">Recordar datos</span>
                                    </div>
                                </fieldset>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-ingresar text-white btn-block btn-login">
                                    {{ __('INGRESAR') }}
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="col-12 ">
                            <p class="text-center  ">
                                <small class="text-left">
                                    <span>¿Aun no tienes una cuenta?</span>

                                    <a class=" color " href="{{ route('register') }}">
                                        {{ __('Registrate') }}
                                    </a>
                                </small>
                            </p>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
