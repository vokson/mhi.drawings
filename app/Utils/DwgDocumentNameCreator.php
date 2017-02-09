<?php

namespace App\Utils;

use App\Document;

class DwgDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'dwg');
    }
}