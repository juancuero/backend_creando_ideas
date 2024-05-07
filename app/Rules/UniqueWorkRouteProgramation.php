<?php

namespace App\Rules;

use App\Models\WorkRouteProgramation;
use Illuminate\Contracts\Validation\Rule;

class UniqueWorkRouteProgramation implements Rule
{
    private $workRouteProgramation;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private int $work_route_id, private int $inspector_id)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->workRouteProgramation = WorkRouteProgramation::where('work_route_id', $this->work_route_id)
            ->where('inspector_id', $this->inspector_id)
            ->first();

        return !$this->workRouteProgramation;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya existe una programación de la ruta ' . $this->workRouteProgramation->workRoute->route . ' con el inspector seleccionado.';
    }
}
