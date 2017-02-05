<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MHI DRAWINGS</title>
</head>

<body>

<div align="center">

    <h2>UPLOAD LIST OF DATABASE</h2>
    {!! Form::open(array('action' => 'DatabaseController@upload', 'method'=>'POST', 'files'=>'true')) !!}

    PROJECT<span/>   {!! Form::radio('project', 'UNF', 'true')  !!} UNF
    <br>
    FILE TYPE<span/>   {!! Form::radio('filetype', 'EXCEL', 'true')  !!} EXCEL
    <br>
    <br>
    {!! Form::file('file') !!}
    <br>
    <br>
    {!! Form::submit('SUBMIT') !!}

    {!! Form::close() !!}

</div>

</body>
</html>
