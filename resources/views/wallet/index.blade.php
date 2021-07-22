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
                        <form action="{{route('liquidation.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="listUsers[]" value="{{Auth::user()->id}}">
                            <input type="hidden" name="tipo" value="user">
                            <button type="submit" class="btn btn-primary">Retirar Todo</button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    @include('wallet.component.tableWallet')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
