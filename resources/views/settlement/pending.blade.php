@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
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
<script src="{{asset('assets/js/liquidation.js')}}"></script>
@endpush

@section('content')
<div id="settlement">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped">
                            <thead class="">
                                <tr class="text-center text-white bg-purple-alt2">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total </th>
                                    <th>Monto Bruto</th>
                                    <th>Feed</th>
                                    <th>Hash</th>
                                    <th>Billetera</th>
                                    <th>Status</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($liquidaciones as $liqui)
                                <tr class="text-center">
                                    <td>{{$liqui->id}}</td>
                                    <td>{{$liqui->fullname}}</td>
                                    <td>{{$liqui->total}}</td>
                                    <td>{{$liqui->monto_bruto}}</td>
                                    <td>{{$liqui->feed}}</td>
                                    <td>{{$liqui->hash}}</td>
                                    <td>{{$liqui->wallet_used}}</td>
                                    <td>{{$liqui->status}}</td>
                                    <td>{{date('Y-M-d', strtotime($liqui->created_at))}}</td>
                                    <td>
                                        <button class="btn btn-info" onclick="vm_liquidation.getDetailComisionLiquidation({{$liqui->id}})">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-success" onclick="vm_liquidation.getDetailComisionLiquidationStatus({{$liqui->id}}, 'aproved')">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button class="btn btn-danger" onclick="vm_liquidation.getDetailComisionLiquidationStatus({{$liqui->id}}, 'reverse')">
                                            <i class="fa fa-reply"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('settlement.componentes.modalDetalles', ['all' => false])
    @include('settlement.componentes.modalAction')
</div>


@endsection

{{-- permite llamar a las opciones de las tablas --}}
@include('layouts.componenteDashboard.optionDatatable')
