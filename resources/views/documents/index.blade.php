@extends('app')


@section('scripts')
    <link rel="stylesheet" href="/css/document_search.css">
    <link rel="stylesheet" href="/css/tablesorter/theme.blue.css">

    <script type="text/javascript" src="/js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="/js/documents/partials.js"></script>
    <script type="text/javascript" src="/js/documents/on_ready.js"></script>
@stop

@section('search_form')
    @include('documents.form')
@stop


@section('search_result')
    <div id="search_results" align="center">
    </div>
@stop