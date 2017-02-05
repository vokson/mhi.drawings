@if ($doc->isDwgExist)
    <a href="{{ action('DocumentController@getSingleDwg', ['id' => $doc->id])  }}">
@endif

<img src="/img/dwg_<?php echo($doc->isDwgExist ? 'ok' : 'fail') ?>.jpg" width="24px" height="24px"/>

@if ($doc->isDwgExist)
    </a>
@endif