<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface WorkFileServiceInterface
{
    public function create(array $data, UploadedFile $file = null);
}
