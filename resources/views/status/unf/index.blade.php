@extends('app')


@section('scripts')
    <link rel="stylesheet" href="/css/unf_status_search.css">
    <link rel="stylesheet" href="/css/tablesorter/theme.blue.css">

    <script type="text/javascript" src="/js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="/js/status/unf/unf_status.js"></script>
@stop

@section('search_form')
    @include('status.unf.form')
@stop


@section('search_result')
    <div id="search_results" align="center">
    </div>
@stop