<?php

namespace App\Interfaces;

interface IFileWriterHandler {
    public function file_writer($address, $regex);
}