<?php

namespace App\Http\Controllers\V1\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Company\CompanyCollection;
use App\Interfaces\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyIndexController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
        $this->resourceCollection = CompanyCollection::class;
    }

    public function __invoke(Request $request): CompanyCollection
    {
        $data = $this->companyRepository->all();

        return $this->respondWithList($data);
    }
}
