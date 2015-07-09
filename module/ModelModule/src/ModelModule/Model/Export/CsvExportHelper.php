<?php

namespace ModelModule\Model\Export;

class CsvExportHelper
{
    /**
     * @param $values
     * @return string
     */
    public function makeCsvLine($values)
    {
        $content = '';
        foreach($values as $key => $record)
        {
            foreach($record as &$value) {
                if (    (strpos($value, ';')  !== false) || (strpos($value, '"')  !== false) ||
                    (strpos($value, ' ')  !== false) || (strpos($value, "\t") !== false) ||
                    (strpos($value, "\n") !== false) || (strpos($value, "\r") !== false))
                {
                    $value = '"' . str_replace('"', '""', $value) . '"';
                }
            }

            $content .= implode(';', $record) . "\n";
        }

        return $content;
    }
}