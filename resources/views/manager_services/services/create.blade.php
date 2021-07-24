@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/librerias/emojionearea.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

{{-- permite llamar las librerias montadas --}}
@push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/js/adminService.js')}}"></script>
@endpush

@section('content')
<div id="adminServices">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                 
                    {{-- <div class="col-12 mt-1">
                        <form action="{{route('package.index')}}" method="get" id="filtro">
                            <fieldset class="form-group">
                                <label for="">Filtro por Grupos</label>
                                <select name="category" class="form-control" required v-on:change="aplicFiltro()">
                                    <option value="" disabled selected>Elige una opcion</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                            @if($name_category == null)
                            <p>Lorem ipsum dolor sit amet consec</p>
                            @else
                            <h5>Categoria Selecionada: {{$name_category}}</h5>
                            @endif
                        </form>
                    </div> --}}
                    <div class="table-responsive mt-2">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                <tr class="text-center">
                                    <td>{{$service->id}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Nuevo Servicio --}}
    @include('manager_services.services.components.modalNew')
    {{-- Modal Editar Servicio --}}
    @include('manager_services.services.components.modalEdit')
    {{-- Modal Descripcion Servicio --}}
    @include('manager_services.services.components.modalDescription')
</div>

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
{{-- permite llamar a las opciones para editor --}}
@include('layouts.componenteDashboard.optionSummernote')

@endsection