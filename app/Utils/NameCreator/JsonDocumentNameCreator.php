<?php

namespace App\Utils\NameCreator;

class JsonDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'json');
    }
}