<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MHI DRAWINGS</title>
</head>

<body>

<div align="center">

    <h2>SERVICE PAGE</h2>

    <h3> <a href="{!! action('ServiceController@maxRevUpdate') !!}">Update Maximum Revisions of Drawings</a></h3>
    <br/>
    <h3> <a href="{!! action('ServiceController@existInfoUpdateForTAF') !!}">TAF - update info about existing files</a></h3>
    <h3> <a href="{!! action('ServiceController@existInfoUpdateForRPA') !!}">RPA - update info about existing files</a></h3>
    <h3> <a href="{!! action('ServiceController@existInfoUpdateForUNF') !!}">UNF - update info about existing files</a></h3>
    <br/>
    <h3> <a href="{!! action('DatabaseController@index') !!}">Upload Information into Database</a></h3>
    <br/>
    <h3> <a href="{!! action('ServiceController@statusInfoUpdateForUNF') !!}">UNF - update info about comments</a></h3>

</div>

</body>
</html>
