<ul>
    @foreach($results as $result)
        @php($offset = substr_count($result, '.'))
        <div class="row">
            {!! str_repeat('<ul>', $offset) !!}
            <li>{{$result}}</li>
            {!! str_repeat('</ul>', $offset) !!}
        </div>
    @endforeach
</ul>