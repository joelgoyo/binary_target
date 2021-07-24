@extends('layouts.dashboard')

{{-- contenido --}}
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-content">
            <div class="card-body card-dashboard">
                <div class="float-right row no-gutters" style="width: 30%;">
                    <div class="col-md-4 col-12">
                        <span class="font-weight-bold">Saldo disponible:</span>
                    </div>
                    <div class="col-md-4 col-12">
                        $ {{number_format($saldoDisponible,2)}}
                    </div>

                    <div class="col-12 col-md-4">
                          @if(\Carbon\Carbon::now()->isFriday())
                        <button class="btn btn-outline-primary" id="retiro" data-toggle="modal"
                        data-target="#modalSaldo"><b>RETIRAR</b></button> @endif

                            <form action="{{route('liquidation.store')}}" method="GET">
                            @csrf
                           
                            <input type="hidden" name="listUsers[]" value="{{Auth::user()->id}}">
                            <input type="hidden" name="tipo" value="user">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    @include('wallet.component.tableWallet')
                    {{--Modal retirar saldo disponible--}}
                    @include('layouts.componenteDashboard.modalRetiro')

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')

