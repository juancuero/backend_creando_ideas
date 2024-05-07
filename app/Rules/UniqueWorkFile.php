<?php

namespace App\Rules;

use App\Models\WorkFile;
use Illuminate\Contracts\Validation\Rule;

class UniqueWorkFile implements Rule
{
    public function __construct(private int $year, private int $month, private int $cycle_id)
    {
    }

    public function passes($attribute, $value)
    {
        $workFile = WorkFile::where('year', $this->year)
            ->where('month', $this->month)
            ->where('cycle_id', $this->cycle_id)
            ->first();

        return !$workFile;
    }

    public function message()
    {
        return 'El archivo ya existe para este año, mes y ciclo';
    }
}
