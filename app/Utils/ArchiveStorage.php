<?php

namespace App\Utils;

use ZipArchive;

class ArchiveStorage
{
    public function createArchive($absoluteFilePaths, $zipPath)
    {

        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZIPARCHIVE::CREATE) === TRUE) {

            foreach ($absoluteFilePaths as $path) {
                if (file_exists($path)) {
                    $zip->addFile($path, basename($path));
                }
            }

            if ($zip->numFiles == 0) return FALSE;

            return ($zip->status == ZipArchive::ER_OK);
        }

        return FALSE;
    }

    public function clean()
    {
        foreach (glob(config('filesystems.archiveStoragePath'). DIRECTORY_SEPARATOR  . '*') as $fileName) {
            if ( (microtime(true) - filectime($fileName) > config('filesystems.archiveStorageTime') )) {
                unlink($fileName);
            }
        }
    }
}