<?php

namespace ES\Utils;

/**
 * Class CSV
 * This class provides simaple operations on csv files
 */
class CSV {

    /**
     * Reads csv file to array
     *
     * @param string $csvPath
     * @return array
     */
    public static function toArray($csvPath) {
        $array = [];
        $headers = [];
        $i = 0;
        $handle = fopen($csvPath, 'r');

        if ($handle) {
            while (($row = fgetcsv($handle)) !== false) {        
                if (empty($headers)) {
                    $headers = $row;filePath
                    continue;
                }

                foreach ($row as $k => $value) {
                    $array[$i][$headers[$k]] = $value;
                }

                $i++;
            }
            
            fclose($handle);
        }

        return $array;
    }

    /**
     * Saves array to csv file
     *
     * @param array $csvRows
     * @param string  $filePath
     * @param bolean  $firstRowAsHeader
     * @return array
     */
    public static function toCsv($csvRows, $filePath, $firstRowAsHeader = true) {
        $fp = fopen($filePath, 'a');
        $headers = [];
        $csvTmpRow = [];

        if (true === $firstRowAsHeader) {
            if (isset($csvRows[0]) && is_array($csvRows[0])) {
                $headers = array_keys($csvRows[0]);
            }

            fputcsv($fp, $headers);
        }

        foreach ($csvRows as $k => $row) {
            fputcsv($fp, $row);
        }
    }
}