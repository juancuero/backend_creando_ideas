<?php

namespace App\Http\Controllers\V1\Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\EmployeeRepository;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeDeleteController extends Controller
{
    public function __construct(private EmployeeRepository $employeeRepository)
    {
    }

    public function __invoke(Request $request, Employee $employee)
    {
        $this->employeeRepository->deleteById($employee->id);

        return $this->respondWithNoContent();
    }
}
