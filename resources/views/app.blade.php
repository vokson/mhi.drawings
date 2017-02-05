<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <title>MHI DRAWINGS</title>
    <link rel="stylesheet" href="/css/search_results.css">
    <link rel="stylesheet" href="/css/tablesorter/theme.blue.css">

    <script type="text/javascript" src="/js/jquery-2.2.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="/js/partials.js"></script>
    <script type="text/javascript" src="/js/on_ready.js"></script>

</head>

<body>

@yield('search_form')

@yield('search_result')

</body>
</html>
