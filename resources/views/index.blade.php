@extends('layouts.master')

@section('title')
    Results
@endsection

@section('content')
    <h1>Results</h1>
    <div class="container">
        <h2>Recursive in blade</h2>
        <ul>
            @each('partials.recursive', $parents, 'category')
        </ul>
        <h2>Recursive result display</h2>
        @foreach($recursiveResults as $result)
            @php($offset = substr_count($result, '.'))
            <li>{{str_repeat('-', $offset).$result}}</li>
        @endforeach
        <h2>Iterative result display</h2>
        @foreach($iterativeResults as $results)
            @php($offset = substr_count($results['title'], '.'))
            <li>{{str_repeat('-', $offset).$results['title']}}</li>
        @endforeach
    </div>
@endsection