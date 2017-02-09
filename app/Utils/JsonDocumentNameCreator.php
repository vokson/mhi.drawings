<?php

namespace App\Utils;

use App\Document;

class JsonDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'json');
    }
}