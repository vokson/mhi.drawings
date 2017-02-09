<?php

namespace App\Utils;

class JsonDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'json');
    }
}