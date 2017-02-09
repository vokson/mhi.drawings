<?php

namespace App\Utils;

use App\Document;

class PdfDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'pdf');
    }
}