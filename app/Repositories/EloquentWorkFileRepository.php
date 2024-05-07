<?php

namespace App\Repositories;

use App\Interfaces\Repositories\WorkFileRepository;
use App\Models\WorkFile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Collection;

class EloquentWorkFileRepository extends EloquentRepository implements WorkFileRepository
{
    private string $defaultSort = '-created_at';

    public array $defaultSelect = [
        'id',
    ];

    private array $allowedFilters = [
        'id',
        'year',
        'month',
        'cycle_id',
    ];

    private array $allowedSorts = [
        'id',
    ];

    private array $allowedFields = [
        'id',
    ];

    private array $allowedIncludes = [

    ];

    public function all(): Collection
    {
        return QueryBuilder::for(WorkFile::class)
            ->allowedFields($this->allowedFields)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->get();
    }


    public function findOneById(int $id): Model
    {
        return QueryBuilder::for(WorkFile::class)
            ->allowedIncludes($this->allowedIncludes)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int) request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for(WorkFile::class)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }

    public function getByYearAndMonth($year, $month)
    {
        return QueryBuilder::for(WorkFile::class)
            ->where('year', $year)
            ->where('month', $month)
            ->get();
    }
}
