<?php

namespace App\Http\Controllers\V1\Company;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\CompanyRepository;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyDeleteController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function __invoke(Request $request, Company $company)
    {
        $this->companyRepository->deleteById($company->id);

        return $this->respondWithNoContent();
    }
}
