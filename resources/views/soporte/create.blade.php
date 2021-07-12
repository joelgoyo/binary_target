@extends('layouts.dashboard')

@section('content')

    <div class="card">
        <div class="card-body">
            <h1 class="text-center">Soporte</h1>

            <form action="{{route('soporte.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                </div>

                <input type="file" name="img" class="form-control-file">

                <button class="btn btn-primary float-right">Enviar</button>
            </form>
        </div>
    </div>
@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
