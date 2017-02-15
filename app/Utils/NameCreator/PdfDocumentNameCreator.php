<?php

namespace App\Utils\NameCreator;

class PdfDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'pdf');
    }
}