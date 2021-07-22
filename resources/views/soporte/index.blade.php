@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-body">
            <h1 class="text-center">Tickets</h1>

            <div class="table-responsive">
                <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Estado</th>
                            <th>Prioridad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($soportes as $soporte)

                            <tr>
                                <td>{{$soporte->getUser->email}}</td>
                                <td>
                                    @if($soporte->estado == '0')
                                        Cerrrado
                                    @elseif($soporte->estado == '1')
                                        Abierto
                                    @endif
                                </td>
                                <td>
                                    @if($soporte->prioridad == '1')
                                        Baja
                                    @elseif($soporte->prioridad == '2')
                                        Media
                                    @elseif($soporte->prioridad == '3')
                                        Alta
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info">Ver</button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ver</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
