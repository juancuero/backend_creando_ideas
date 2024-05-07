<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AnomalyRepository;
use App\Models\Anomaly;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentAnomalyRepository extends EloquentRepository implements AnomalyRepository
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
        return QueryBuilder::for(Anomaly::class)
            ->allowedIncludes($this->allowedIncludes)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int) request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for(Anomaly::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }
}