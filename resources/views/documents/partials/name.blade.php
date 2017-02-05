@if ($doc->isPdfExist)
    <a href="{{ action('DocumentController@getSinglePdf', ['id' => $doc->id])  }}">
@endif

{{ $doc->name }}

@if ($doc->isPdfExist)
    </a>
@endif