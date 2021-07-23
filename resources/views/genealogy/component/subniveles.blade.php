<a class="met" onclick="tarjeta( {{$data}}, '{{route('genealogy_type_id', [strtolower($type), base64_encode($data->id)])}}')">
    @if (empty($data->photoDB))
        <img src="{{asset('img/tree/tree.svg')}}" class="rounded-circle" style="margin-top: 5px;" width="45px" alt="{{$data->name}}" title="{{$data->name}}">
    @else
        <img src="{{asset('storage/'.$data->photoDB)}}" class="rounded-circle" width="55px" height="55" alt="{{$data->name}}" title="{{$data->name}}">
    @endif
</a>