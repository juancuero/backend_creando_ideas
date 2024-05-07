<?php

namespace App\Http\Controllers\V1\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Employee\EmployeeCollection;
use App\Interfaces\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeePaginateController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
        $this->resourceCollection = EmployeeCollection::class;
    }

    public function __invoke(Request $request): EmployeeCollection
    {
        $data = $this->employeeRepository->findByFilters();

        return $this->respondWithCollection($data);
    }
}
