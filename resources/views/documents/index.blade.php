@extends('app')


@section('search_form')
    @include('documents.form')
@stop


@section('search_result')
    <div id="search_results" align="center">
    </div>
@stop