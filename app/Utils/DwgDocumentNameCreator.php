<?php

namespace App\Utils;

use App\Document;

class DwgDocumentNameCreator extends DocumentNameCreator
{
    public function name(Document $doc)
    {
        return $this->createPathByDocAndExtension($doc, 'dwg');
    }
}