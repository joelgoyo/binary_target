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
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div class="card-header d-flex align-items-center p-2" style="background: #141414;">
                                            <img src="{{asset('assets/img/packages/'.$items->price.'.jpeg')}}" alt="" style="width: 100%; heigh:100%;">
                                        </div>
                                        <a target="_blank" href="{{route('shop.procces', $items->id)}}" style="background: #cb9b32; border-radius: 0px;" class="btn btn-block text-white waves-effect waves-light" @if($invertido >= $items->price) disabled @endif>
                                            
                                                @if($invertido == null)
                                                Comprar
                                            @else
                                                Upgrade
                                            @endif
                                            </a>  
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