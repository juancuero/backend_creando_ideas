<?php

namespace App\Repositories;

use App\Interfaces\Repositories\MunicipalityRepository;
use App\Models\Municipality;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentMunicipalityRepository extends EloquentRepository implements MunicipalityRepository
{
    private string $defaultSort = '-created_at';

    public array $defaultSelect = [
        'id',
    ];

    private array $allowedFilters = [
        'id',
    ];

    private array $allowedSorts = [
        'id',
    ];

    private array $allowedFields = [
        'id',
    ];

    private array $allowedIncludes = [

    ];

    public function findOneById(int $id): Model
    {
        return QueryBuilder::for(Municipality::class)
            ->allowedIncludes($this->allowedIncludes)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int) request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for(Municipality::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }
}
