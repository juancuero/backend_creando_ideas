<?php

namespace App\Interfaces\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface BaseRepository
{
    /**
     * Set the relationships of the query.
     *
     * @param array $with
     * @return BaseRepository
     */
    public function with(array $with = []): self;

    /**
     * Set withoutGlobalScopes attribute to true and apply it to the query.
     *
     * @return BaseRepository
     */
    public function withoutGlobalScopes(): self;

    /**
     * Find a resource by id.
     *
     * @param int $id
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOneById(int $id): Model;

    /**
     * Find a resource by key value criteria.
     *
     * @param array $criteria
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOneBy(array $criteria): Model;

    /**
     * Search All resources by spatie query builder.
     *
     * @return LengthAwarePaginator
     */
    public function findByFilters(): LengthAwarePaginator;

    /**
     * Save a resource.
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * Update a resource.
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

    /**
     * Get all models.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Delete model by id.
     *
     * @param int $modelId
     * @return bool
     */
    public function deleteById(int $modelId): bool;

    /**
     * Exists By.
     *
     * @param array $criteria
     * @return bool
     * @throws ModelNotFoundException
     */
    public function existsBy(array $criteria): bool;

    /**
     * Find By.
     *
     * @param array $criteria
     * @return Collection
     * @throws ModelNotFoundException
     */
    public function findBy(array $criteria): Collection;
}
