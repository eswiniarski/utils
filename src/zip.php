<?php

namespace ES\Utils;

use \ZipArchive;
use \RecursiveIteratorIterator; 
use \RecursiveDirectoryIterator;

/**
 * Class ZIP
 * This class provides basic operations on zip files
 */
class ZIP {

     /**
     * Creates zip file out of given directory
     *
     * @param string $dirPath
     * @param string $filePath
     * @return bolean true on success false other case
     */
    public static function create($dirPath, $filePath) {
        $zip = new ZipArchive();    
        $opened = $zip->open($filePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        if (false === $opened) {
            return false;
        }

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dirPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (false === $file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($dirPath) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return true;
    }

    /**
     * Extracts zip file to given location
     *
     * @param string $zipFilePath
     * @param string $destination
     * @return bolean true on success false other case
     */
    public static function extract($zipFilePath, $destination = '') {
        $zip = new ZipArchive;
        $opened = $zip->open($zipFilePath);

        if (false === $opened) {
            return false;
        }

        $zip->extractTo($destination);
        $zip->close();

        return true;
    }

}
