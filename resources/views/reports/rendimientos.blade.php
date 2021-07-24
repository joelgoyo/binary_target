@extends('layouts.dashboard')

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable">
                            <thead class="">

                                <div class="col-12 col-md-4">
                                    <form action="{{route('reports.actualizarganancias')}}" method="post">
                                        @csrf

                                        <input type="hidden" name="tipo" value="user">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>

                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>invertido</th>
                                    <th>ganancia</th>
                                    <th>progreso</th>
                                    <th>limite de ganancia</th>
                                    <th>Fecha de Creación</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($inversiones as $wallet)
                                <tr class="text-center">
                                    <td>{{$wallet->id}}</td>
                                    <td>{{$wallet->ganacia}}</td>
                                    <td>{{$wallet->invertido}}</td>
                                    <td>{{$wallet->ganacia}}</td>
                                    <td>{{$wallet->progreso}}%</td>
                                    <td>{{$wallet->limite}}</td>
                                @endforeach

                           {{--    @foreach ($u as $wallet)
                                <tr class="text-center">
                                    <td>{{$wallet->iduser}}</td>
                                    <td>{{$wallet->invertido}}</td>
                                    <td>{{$wallet->referido}}</td>
                                    <td>{{$wallet->descripcion}}</td>
                                    <td>{{$wallet->monto}}</td>

                                    @if ($wallet->status == '0')
                                    <td> <a class=" btn btn-info text-white text-bold-600">Pendiente</a></td>
                                    @elseif($wallet->status == '1')
                                    <td> <a class=" btn btn-success text-white text-bold-600">Pagada</a></td>
                                    @elseif($wallet->status == '2')
                                    <td> <a class=" btn btn-danger text-white text-bold-600">Cancelada</a></td>
                                    @elseif($wallet->status == '3')
                                    <td> <a class=" btn btn-danger text-white text-bold-600">Reservada</a></td>
                                    @endif

                                    <td>{{date('Y-M-d', strtotime($wallet->created_at))}}</td>
                                </tr>
                                @endforeach
                               --}}
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


