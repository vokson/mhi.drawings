<?php

namespace App\Utils\NameCreator;

class PdfCommentDocumentNameCreator extends DocumentNameCreator
{
    public function name($doc)
    {
        return $this->createPathByDocAndExtension($doc, 'comment.pdf');
    }
}