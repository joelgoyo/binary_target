@extends('layouts.dashboard')

{{-- vendor css --}}
@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('assets/app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/tether.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('assets/app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
@endpush

{{-- page css --}}
@push('page_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/dashboard-analytics.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/css/pages/card-analytics.css')}}">
@endpush

{{-- custom css --}}
@push('custom_css')
<style>
    @media (max-width: 537px) {
        .d-redirection{
            flex-direction: row-reverse;
        }
    }

    input[type='radio']:after {
        width: 20px;
        height: 20px;
        border-radius: 15px;
        top: -4px;
        left: -1px;
        position: relative;
        background-color: #002614;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid #00BE54;
    }

    input[type='radio']:checked:after {
        width: 20px;
        height: 20px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #00BE54;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid #00BE54;
    }

</style>
@endpush

{{-- page vendor js --}}
@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/tether.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
@endpush

{{-- page js --}}
@push('page_js')
{{-- <script src="{{asset('assets/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script> --}}
{{-- <script src="{{asset('assets/app-assets/js/scripts/cards/card-statistics.js')}}"></script> --}}
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush
{{-- custom js --}}
@push('custom_js')
<script src="{{asset('assets/js/dashboard.js')}}"></script>
@endpush

@section('content')
<section id="dashboard-analytics">
    @if (Auth::user()->admin == 1)
    {{-- Primera Seccion --}}
    @include('dashboard.componente.adminsection')
    {{-- Fin Primera Seccion --}}
    @else
    {{-- Primera Seccion --}}
    @include('dashboard.componente.firstsection')
    {{-- Fin Primera Seccion --}}
    {{-- Segundo Seccion --}}
    @include('dashboard.componente.secondsection')
    {{-- Fin Segundo Seccion --}}
    {{-- Tercera Seccion --}}
    {{--@include('dashboard.componente.thirdsection')--}}
    {{-- Fin Tercera Seccion --}}
    {{--Modal retirar saldo disponible--}}
    @include('layouts.componenteDashboard.modalRetirar')
    @endif

    {{-- link de referido --}}
    @include('layouts.componenteDashboard.linkReferido')
</section>
@endsection
