<?php

namespace App\Utils;

use App\Document;

class PdfDocumentNameCreator extends DocumentNameCreator
{
    public function name(Document $doc)
    {
        return $this->createPathByDocAndExtension($doc, 'pdf');
    }
}