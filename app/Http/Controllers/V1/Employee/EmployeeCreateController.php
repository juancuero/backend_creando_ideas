<?php

namespace App\Http\Controllers\V1\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Employee\EmployeeCreateRequest;
use App\Http\Resources\Api\V1\Employee\EmployeeResource;
use App\Interfaces\Repositories\EmployeeRepository;

class EmployeeCreateController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
        $this->resourceItem = EmployeeResource::class;
    }

    public function __invoke(EmployeeCreateRequest $request): EmployeeResource
    {
        $employee = $this->employeeRepository->store($request->all());

        return $this->respondWithItem($employee);
    }
}
