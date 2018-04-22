@foreach($results as $result)
    @php($offset = substr_count($result, '.'))
    {!! str_repeat('<ul>', $offset+1) !!}
    <li>{{$result}}</li>
    {!! str_repeat('</ul>', $offset+1) !!}
@endforeach