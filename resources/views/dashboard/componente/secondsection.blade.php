<div class="row">

    <div class="col-sm-6 col-md-4 col-12 mt-1">
        <div class="card" style="height: 220px;">
            <div class="card-body pt-1">
                <div class="float-right">
                    <img class="float-right" src="{{ asset('assets/img/icon/Group 130.svg') }}" width="110%"
                        alt="">
                </div>

                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 pl-0 white">
                    <h6 class="mt-1 mb-0 text-white">Link de referido</h6>
                </div>
    
                <div class="card-sub d-flex align-items-center ">
                    <h2 class="gold text-bold-700 mb-0">INVITA A<br>PERSONAS<br></h2>
                </div>
                <div class="card-header d-flex align-items-center white mt-2">
                    <button class="btn btn-outline-primary btn-block" style="boder-color=#D6A83E;"
                        onclick="getlink('{{Auth::user()->binary_side_register}}')"><b>LINK DE
                            REFERIDO <i class="fa fa-copy"></i></b></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 col-12 mt-1">
        <div class="card p-2" style="height: 220px;">
            
            <h6 class="mt-1 mb-0 text-white text-center">Paquete de inversión</h6>
            
            <div class="text-center" style="width: 100%; height: 100%;">
               
                <img class="img" src="{{Auth::user()->inversionMasAlta() != null ?Auth::user()->inversionMasAlta()->getPackageOrden->img() : asset('assets/img/sistema/favicon.png')}}" alt="binary_target" style="width: 70%; height:90%">
            
            </div>

        </div>
    </div>

    <div class="col-sm-6 col-md-5 col-12 mt-1">
        <div class="card" style="height: 220px;">
            <div class="card-body pt-1">
                <div class="float-right">
                    <img class="float-right" src="{{ asset('assets/img/icon/Group2.svg') }}" width="99" height="91"
                        alt="">
                </div>

                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 pl-0 white">
                    <h6 class="mt-1 mb-0 text-white">Lado Binario</h6>
                </div>

                <div class="card-sub d-flex align-items-center ">
                    <h1 class="gold text-bold-700 mb-0">
                        @if (Auth::user()->binary_side_register == 'I')
                        IZQUIERDA
                        @else
                        DERECHA
                        @endif
                    </h1>
                </div>

                <div class="row" style="margin-top: 100px;">
                    <div class="col col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="" v-on:click="updateBinarySide('I')" @if (Auth::user()->binary_side_register == 'I') checked @endif>
                            <label class="form-check-label ml-1" for="inlineRadio1">IZQUIERDO</label>
                        </div>
                    </div>

                    <div class="col col-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="" v-on:click="updateBinarySide('D')" @if (Auth::user()->binary_side_register == 'D') checked @endif>
                            <label class="form-check-label ml-1" for="inlineRadio2">DERECHO</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-12">
        <div class="card" style="height: 893px;">
            <div class="card-body pt-1">
                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 pl-0 white">
                    <h6 class="mt-1 mb-0 text-white">Proximo rango</h6>
                </div>

                {{--<img src="" alt="" style="width: 184.48px; height: 182.26px; left:531px; top: 790.12px;">--}}
                
                <div class="row mt-5 text-center no-gutters" style="height: 320.77px;">
                    <div class="col col-12 col-md-4 align-self-end">
                        <img src="" alt="" style="width: 184.48px; height: 182.26px;">
                        <span class="d-block">Rango 1</span>    
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="" alt="" style="width: 228px; height: 228px;">
                        <span class="d-block">Rango 2</span>
                    </div>
                    <div class="col col-12 col-md-4 align-self-end">
                        <img src="" alt="" style="width: 184.48px; height: 182.26px;">
                        <span class="d-block">Rango 3</span>
                    </div>
                </div>
                
                <hr style="margin-top: 6em;">
                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 pl-0 white">
                    <h6 class="mt-1 mb-0 text-white">Total puntos:</h6>
                </div>
                <div class="card-sub d-flex align-items-center ">
                    <h2 class="gold text-bold-700 mb-0"><b>2.350</b></h2>
                </div>
                <div class="d-flex align-items-center">

                    <div class="progress mb-2 mt-2" style="height: 25px;width: 94%;">
                        <div id="bar" class="progress-bar active" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                        </div>
                        
                    </div>
                    
                    <div class="card-sub d-flex align-items-center ">
                        <p class="text-bold-700 mb-0 text-white ml-1">47%
                        </p>
                    </div>
                   
                </div>
                <h6 class="my-1 mb-0 text-white">Proximo rango = 5000</h6>

                <h4 class="text-white"><b> Bono de bienvenida</b></h4>
                <div class="card-header d-flex align-items-center text-right pb-0 pt-0 pl-0 white">
                    <h6 class="mt-1 mb-0 text-white">Total puntos:</h6>
                </div>
                <div class="card-sub d-flex align-items-center ">
                    <h2 class="gold text-bold-700 mb-0"><b>500</b></h2>
                </div>
                <div class="d-flex align-items-center">

                    <div class="progress mb-2 mt-2" style="height: 25px;width: 94%;">
                        <div id="bar" class="progress-bar active" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width: 10%">
                        </div>
                        
                    </div>
                    
                    <div class="card-sub d-flex align-items-center ">
                        <p class="text-bold-700 mb-0 text-white ml-1">60%
                        </p>
                    </div>
                   
                </div>

                <h6 class="my-1 mb-0 text-white">Proximo bono = 10000</h6>
            </div>
        </div>
    </div>
</div>

{{-- Segundo Cuadros -> Graficas de Comisiones e inversiones --}}
<div class="row mb-4">
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card text-white h-100">
            <div class="card-content">
                <div class="card-body">
                    <div id="gcomisiones"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 mt-1">
        <div class="card h-100">
            <div class="card-content">
                <div class="card-body">
                    <h6 class="mt-1 mb-0 text-white">Total de ventas</h6>
                </div>
            </div>
        </div>
    </div>
</div>