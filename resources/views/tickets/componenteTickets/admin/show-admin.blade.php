@extends('layouts.dashboard')

@section('content')

<section>
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-6 col-12">
            <div class="card ">

                <div class="card-header">
                    <h4 class="card-title text-white">Revisando el Ticket #{{ $ticket->id }}</h4>
                    <h4 class="card-title text-white">Usuario: <span class="text-white">{{ $ticket->getUser->fullname}}</span></h4>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="row">

                                <div class="col-12">
                                    <label class="form-label text-white" for="issue"><b>Asuto del Ticket</b></label>
                                    <input class="form-control  rounded-0" type="text" value="{{ $ticket->issue }}" readonly/>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="text-white">Estado del Ticket</label>
                                            <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                            <select class="custom-select form-control rounded-0" disabled>
                                                <option value="0" @if($ticket->status == '0') selected @endif>Abierto</option>
                                                <option value="1" @if($ticket->status == '1') selected @endif>Cerrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-2">
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="text-white">Prioridad del Ticket</label>
                                            <span class="text-danger text-bold-600">OBLIGATORIO</span>
                                            <select class="custom-select form-control rounded-0" disabled>
                                                <option value="0" @if($ticket->priority == '0') selected @endif>Alto</option>
                                                <option value="1" @if($ticket->priority == '1') selected @endif>Medio</option>
                                                <option value="2" @if($ticket->priority == '2') selected @endif>Bajo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3 mb-1">
                                    <label class="form-label text-white"><b>Chat con el usuario</b></label>

                                    <section class="chat-app-window mb-2  rounded-0">
                                        <div class="active-chat">
                                            <div class="user-chats">
                                                <div class="chats chat-thread p-2">

                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar box-shadow-1">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/photo/'.Auth::user()->photoDB)}}" alt="avatar" height="36" width="36">
                                                                @else
                                                                <img src="{{ asset('assets/img/sistema/favicon.png') }}" alt="avatar" height="36" width="36">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>Hola!. ¿Cómo podemos ayudar? 😄</p>
                                                                <small class=" text-secondary">admin@binarystage.com</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach ( $message as $item )
                                                    {{-- user --}}
                                                    @if ($item->type == 0)
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <span class="avatar box-shadow-1">
                                                                <img src="{{ asset('assets/img/sistema/favicon.png') }}" alt="avatar" height="36" width="36">
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>{{ $item->message }}</p>
                                                                <small class=" text-secondary">{{ $item->getUser->email}}</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- admin --}}
                                                    @elseif ($item->type == 1)
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <span class="avatar box-shadow-1">
                                                                @if (Auth::user()->photoDB != NULL)
                                                                <img src="{{asset('storage/photo/'.Auth::user()->photoDB)}}" alt="avatar" height="36" width="36">
                                                                @else
                                                                <img src="{{ asset('assets/img/sistema/favicon.png') }}" alt="avatar" height="36" width="36">
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                             <p>{{ $item->message }}</p>
                                                             <small class="text-secondary">admin@binarystage.com</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>

                            <div class="col-12"><a href="{{ route('ticket.list-admin') }}" class="btn btn-primary float-right mb-2">Regresar a la lista</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection