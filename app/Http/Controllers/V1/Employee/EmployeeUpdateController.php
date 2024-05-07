<?php

namespace App\Http\Controllers\V1\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Api\V1\Employee\EmployeeResource;
use App\Interfaces\Repositories\EmployeeRepository;
use App\Models\Employee;

class EmployeeUpdateController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
        $this->resourceItem = EmployeeResource::class;
    }

    public function __invoke(EmployeeUpdateRequest $request, Employee $employee): EmployeeResource
    {
        $employee = $this->employeeRepository->update($employee, $request->all());

        return $this->respondWithItem($employee);
    }
}
