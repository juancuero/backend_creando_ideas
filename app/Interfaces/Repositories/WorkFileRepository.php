<?php

namespace App\Interfaces\Repositories;

interface WorkFileRepository extends BaseRepository
{
    public function getByYearAndMonth($year, $month);
}
