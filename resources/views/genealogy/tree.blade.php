@extends('layouts.dashboard')

@section('title', $type)

@push('custom_css')
<link rel="stylesheet" href="{{asset('assets/css/arbol/main.css')}}">
@endpush

@section('content')

<h1 class="text-white">Arbol Binario</h1>

<div class="container">
    <div class="row">

        <div class="col-md-6 col-sm-12 text-center">
            <div class="row">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" d-flex white mt-2">
                                <button class="btn-tree text-left" style="width: 247px;">Puntos Por la Derecha:</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" d-flex white mt-2">
                                <button class="btn-tree text-left" style="width: 247px;">Puntos por la Izquierda:</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-4 col-sm-12 art" id="tarjeta">

            <div class="container p-2">
                <div class="row">

                    <div class="col-4">
                        <img id="imagen" class="rounded-circle" width="110px" height="110px">
                    </div>

                    <div class="col-8">
                        <div class="white">
                            <p><b>Fecha de Ingreso:</b> <span id="fecha_ingreso"></span></p>
                        </div>
                        <div class="white">
                            <p><b>Email:</b> <span id="email"></span></p>
                        </div>
                        <div class="white">
                            <p><b>Patrocinador:</b> <span id="patrocinador"></span></p>
                        </div>
                    </div>
                    <div class="d-flex white mb-2 col-12" style="margin-left: 66px;">
                        <a class="white btn-tree text-center" style="margin-left: 72px;" id="ver_arbol" href=> Ver Arbol</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="col-12">
    <div class="padre">
        <ul>
            <li class="baseli">

                {{-- usuario principal --}}
                <a class="base" href="#">
                    @if (empty($base->photoDB))
                    <img src="{{asset('img/tree/tree.svg')}}" alt="{{$base->name}}" title="{{$base->name}}"
                        class="pt-1 rounded-circle" style="height: 107%;margin-left: 0px;margin-top: -8px;">
                    @else
                    <img src="{{asset('storage/'.$base->photoDB)}}" alt="{{$base->name}}" title="{{$base->name}}"
                        class="rounded-circle" width="97px" height="100px" style="border: 2px solid #095526">                        
                    @endif
                </a>
                
                {{-- Nivel 1 --}}
                <ul>
                    @foreach ($trees as $child)
                    {{-- genera el lado binario derecho haciendo vacio --}}
                    @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' => count($trees),'ladouser' => $child->binary_side])
                    <li href="#prestamo" data-toggle="modal">
                        @include('genealogy.component.subniveles', ['data' => $child])
                        @if (!empty($child->children))
                        {{-- nivel 2 --}}
                        <ul>
                            @foreach ($child->children as $child2)
                            {{-- genera el lado binario derecho haciendo vacio --}}
                            @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' => count($child->children),'ladouser' => $child->binary_side])
                            <li>
                                @include('genealogy.component.subniveles', ['data' => $child2])
                                @if (!empty($child2->children))
                                {{-- nivel 3 --}}
                                <ul>
                                        @foreach ($child2->children as $child3)
                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                        @include('genealogy.component.sideEmpty', ['side' => 'D', 'cant' => count($child2->children),'ladouser' => $child2->binary_side])
                                        <li>
                                            @include('genealogy.component.subniveles', ['data' => $child3])
                                            @if (!empty($child->children))
                                             {{-- nivel 4 
                                            <ul>
                                                @foreach ($child->children as $child)
                                                <li>
                                                    @include('genealogy.component.subniveles', ['data' => $child])
                                                    @if (!empty($child->children))
                                                     nivel 5 
                                                    <ul>
                                                        @foreach ($child->children as $child)
                                                        <li>
                                                            @include('genealogy.component.subniveles', ['data' => $child])
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    fin nivel 5
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                             fin nivel 4  --}}
                                            @endif
                                        </li>
                                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                                        @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' => count($child2->children),'ladouser' => $child2->binary_side])
                                        @endforeach 
                                    </ul>
                                {{-- fin nivel 3 --}}
                                @endif
                            </li>
                            {{-- genera el lado binario izquierdo haciendo vacio --}}
                            @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' => count($child->children),'ladouser' => $child->binary_side])
                            @endforeach
                        </ul>
                        {{-- fin nivel 2 --}}
                        @endif
                    </li>
                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                    @include('genealogy.component.sideEmpty', ['side' => 'I', 'cant' => count($trees),'ladouser' => $child->binary_side])
                    @endforeach
                </ul>
                {{-- fin nivel 1 --}}
            </li>
        </ul>
    </div>
</div>

@if (Auth::id() != $base->id)
<div class="col-12 text-center">
    <a class="btn btn-info" href="{{route('genealogy_type', strtolower($type))}}">Regresar a mi arbol</a>
</div>
@endif

<script type="text/javascript">
    function tarjeta(data, url) {

        if (data.photoDB == null) {
            $('#imagen').attr('src', "{{asset('img/tree/tree.svg')}}");
        } else {
            $('#imagen').attr('src', '/storage/' + data.photoDB);
        }

        $('#fecha_ingreso').text(data.created_at);

        $('#email').text(data.email);

        $('#patrocinador').text(data.email);
        
       
        // if (data.status == 0) {
        //     $('#estado').html('<span class="badge badge-warning">Inactivo</span>');
        // } else if (data.status == 1) {
        //     $('#estado').html('<span class="badge badge-success">Activo</span>');
        // } else if (data.status == 2) {
        //     $('#estado').html('<span class="badge badge-danger">Eliminado</span>');
        // }

        // $('#inversion').text(data.inversion);

        $('#ver_arbol').attr('href', url);

        $('#tarjeta').removeClass('d-none');
    }
</script>

@endsection
