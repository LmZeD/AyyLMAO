@extends('layouts.master')

@section('title')
    Results
@endsection

@section('content')
    @include('partials.sessionMessages')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <h1>Results</h1>
                <div class="panel-body">
                    @include('partials.createNewCategoryModal')
                    <a href="#" data-toggle="modal" data-target="#modal_view"><h5
                                class="text-center btn btn-success">Create new category</h5></a>
                    <h2>Recursive in blade</h2>
                    <div class="row">
                        <ul>
                            @each('partials.recursive', $parents, 'category')
                        </ul>
                    </div>
                    <h2>Recursive result display</h2>
                    @include('partials.foreachPrinter',['results' => $recursiveResults])
                    <h2>Iterative result display</h2>
                    @include('partials.foreachPrinter',['results' => $iterativeResults])
                </div>
            </div>
        </div>
    </div>
@endsection