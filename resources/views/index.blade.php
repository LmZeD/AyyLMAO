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
        @include('partials.foreachPrinter',['results' => $recursiveResults])
        <h2>Iterative result display</h2>
        @include('partials.foreachPrinter',['results' => $iterativeResults])
    </div>
@endsection