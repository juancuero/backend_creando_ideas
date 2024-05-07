<?php

namespace App\Http\Controllers\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Company\CompanyResource;
use App\Interfaces\Repositories\CompanyRepository;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyShowController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
        $this->resourceItem = CompanyResource::class;
    }

    public function __invoke(Request $request, Company $company): CompanyResource
    {
        return $this->respondWithItem($company);
    }
}
