<?php

use App\Interfaces\IFileReaderHandler;
use App\Interfaces\IFileWriterHandler;

class FileHandler implements IFileReaderHandler, IFileWriterHandler {
    public function file_reader($address, $regex)
    {
        $handle = fopen($address, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // info array
                preg_match("/$regex/", $line, $output_array);
                // add it to database
            }
        }
        fclose($handle);
    }
    public function file_writer($address, $regex)
    {
        
    }
}