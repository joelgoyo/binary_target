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

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
