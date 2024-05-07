<?php

namespace App\Interfaces\Services;

use App\Models\Cycle;
use App\Models\Inspector;

interface WorkRouteServiceInterface
{
    public function getRoutePending(int $year, int $month, Cycle $cycle);

    public function getDetailByYearAndMonthAndCycle(int $year, int $month, Cycle $cycle);

    public function getByIdsAndInspectors($dataFilter);

    public function getWorkByInspector(Inspector $inspector);
}
