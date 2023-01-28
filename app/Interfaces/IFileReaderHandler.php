<?php

namespace App\Interfaces;

interface IFileReaderHandler {
    public function file_reader($address, $regex);
}