<?php

namespace App\Utils\NameCreator;

class DwgDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'dwg');
    }
}