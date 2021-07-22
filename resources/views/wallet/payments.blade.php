@extends('layouts.dashboard')

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">

                                <tr class="text-center text-white bg-purple-alt2">                                
                                    <th>ID</th>
                                    <th>Fecha</th> 
                                    <th>Usuario</th> 
                                    <th>Descripcion</th>
                                    <th>Monto</th>
                                    <th>Hash</th>
                                    <th>Estado</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($payments as $item)
                                <tr class="text-center">
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->getWalletReferred->fullname}}</td>
                                    <td>{{$item->descripcion}}</td>
                                      <td>$ {{number_format($item->monto,2)}}</td>
                                     <td>{{$item->hash}}</td>
                                    @if ($item->status == '0')
                                    <td>En espera</td>
                                    @elseif($item->status == '1')
                                    <td>Pagado</td>
                                    @elseif($item->status == '2')
                                    <td>Cancelado</td>
                                    @endif
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')


