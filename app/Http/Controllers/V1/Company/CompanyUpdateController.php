<?php

namespace App\Http\Controllers\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Company\CompanyUpdateRequest;
use App\Http\Resources\Api\V1\Company\CompanyResource;
use App\Interfaces\Repositories\CompanyRepository;
use App\Models\Company;

class CompanyUpdateController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
        $this->resourceItem = CompanyResource::class;
    }

    public function __invoke(CompanyUpdateRequest $request, Company $company): CompanyResource
    {
        $company = $this->companyRepository->update($company, $request->all());

        return $this->respondWithItem($company);
    }
}
