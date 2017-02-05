<?php

namespace App\Utils;

use App\Document;


abstract class DocumentNameCreator
{
    protected function createPathByDocAndExtension(Document $doc, $extension)
    {
        $path = config('filesystems.documentStoragePath') . DIRECTORY_SEPARATOR . $doc->path . DIRECTORY_SEPARATOR;
        $name = $doc->project . ' ' . $doc->name . '_Rev' . sprintf("%02d", $doc->revision) . '_' . sprintf("%02d", $doc->part) . '.' . $extension;

        return $path . $name;
    }

    abstract public function name(Document $doc);
}