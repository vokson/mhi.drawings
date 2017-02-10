<?php

namespace App\Utils\NameCreator;

abstract class DocumentNameCreator
{
    protected function createPathByDocAndExtension($doc, $extension)
    {
        $path = config('filesystems.documentStoragePath') . DIRECTORY_SEPARATOR . $doc->path . DIRECTORY_SEPARATOR;
        $name = $doc->project . ' ' . $doc->name . '_Rev' . sprintf("%02d", $doc->revision) . '_' . sprintf("%02d", $doc->part) . '.' . $extension;

        return $path . $name;
    }

    abstract public function name($doc);
}