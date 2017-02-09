<?php

namespace App\Utils;

use App\Document;

class PdfCommentDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, '.comment.pdf');
    }
}