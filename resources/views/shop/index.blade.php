@extends('layouts.dashboard')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush


@section('content')
<div id="adminServices">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        @foreach ($packages as $items)
                            <div class="col col-md-4">
                                <div class="card text-center" style="background:#011E0C">
                                    <div class="card-body">
                                        <div class="card-header d-flex align-items-center">
                                            <img src="{{asset('assets/img/packages/'.$items->price.'.jpeg')}}" alt="" style="width: 100%; heigh:100%;">
                                        </div>
                                        {{-- <form action="{{route('shop.procces', $items->id)}}" method="GET" target="_blank" class="d-inline"> --}}
                                        @csrf
                                        <button type="submit" style="background: #cb9b32;" class="btn btn-block text-white" @if($invertido >= $items->price) disabled @endif>
                                            <a target="_blank" href="{{route('shop.procces', $items->id)}}">
                                                @if($invertido == null)
                                                Comprar
                                            @else
                                                Upgrade
                                            @endif
                                            </a>
                                        </button>    
                                      
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>  
                        @endforeach
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection