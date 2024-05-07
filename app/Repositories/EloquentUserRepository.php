<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    private string $defaultSort = '-created_at';

    public array $defaultSelect = [
        'id',
        'username',
        'first_name',
        'last_name',
        'email',
        'role_id',
        'active',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = [
        'active',
    ];

    private array $allowedSorts = [
        'id',
        'username',
        'first_name',
        'last_name',
        'email',
        'role_id',
        'active',
        'created_at',
        'updated_at',
    ];

    private array $allowedFields = [
        'id',
        'username',
        'first_name',
        'last_name',
        'email',
        'role_id',
        'active',
        'created_at',
        'updated_at',
    ];

    private array $allowedIncludes = [
        'role',
    ];

    public function findOneById(int $id): Model
    {
        return QueryBuilder::for(User::class)
            ->allowedFields($this->allowedFields)
            ->allowedIncludes($this->allowedIncludes)
            ->where('id', $id)
            ->firstOrFail();
    }

    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int) request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for(User::class)
            ->allowedFields($this->allowedFields)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return QueryBuilder::for(User::class)
            ->allowedFields($this->allowedFields)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->get();
    }

    public function update(Model $model, array $data): Model
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        return parent::update($model, $data);
    }
}
