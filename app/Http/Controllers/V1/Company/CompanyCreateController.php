<?php

namespace App\Http\Controllers\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Company\CompanyCreateRequest;
use App\Http\Resources\Api\V1\Company\CompanyResource;
use App\Interfaces\Repositories\CompanyRepository;

class CompanyCreateController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
        $this->resourceItem = CompanyResource::class;
    }

    public function __invoke(CompanyCreateRequest $request): CompanyResource
    {
        $company = $this->companyRepository->store($request->all());

        return $this->respondWithItem($company);
    }
}
