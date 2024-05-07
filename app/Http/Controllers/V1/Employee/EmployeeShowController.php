<?php

namespace App\Http\Controllers\V1\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Employee\EmployeeResource;
use App\Interfaces\Repositories\EmployeeRepository;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeShowController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
        $this->resourceItem = EmployeeResource::class;
    }

    public function __invoke(Request $request, Employee $employee): EmployeeResource
    {
        return $this->respondWithItem($employee);
    }
}
