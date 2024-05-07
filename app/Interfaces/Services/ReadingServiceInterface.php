<?php

namespace App\Interfaces\Services;

use App\Models\Reading;
use App\Models\WorkRoute;

interface ReadingServiceInterface
{
    public function create(array $data);

    public function byRouteIdAndInspector(array $data);

    public function orderReading(WorkRoute $workRoute);

    public function readingsByAnomalies(array $data);

    public function readingsByCuentas(array $data);

    //public function update(Reading $reading, array $data);

    //public function delete(Reading $reading);
}
