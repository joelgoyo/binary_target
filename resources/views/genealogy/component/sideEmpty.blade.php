@if (strtolower($type) == 'tree')
@if ($cant < 2 && $ladouser == $side)
<li>
    <a href="javascript:;" class="rounded-circle"><img src="{{asset('img/tree/add.svg')}}" class="rounded-circle" style="margin-top: 18px" width="20px" alt="add"></a>
</li>
@endif
@endif