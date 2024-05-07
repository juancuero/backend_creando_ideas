<?php

namespace App\Interfaces\Services;
 

interface ReReadingServiceInterface
{
    public function generateRoute(array $data); 
    public function processReReading(array $data); 
    public function listReReading(array $data); 
}
