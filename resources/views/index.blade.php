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
        <h2>Recursive</h2>

    </div>
@endsection