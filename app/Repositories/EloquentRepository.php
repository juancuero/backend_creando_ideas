<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository implements BaseRepository
{
    protected Model $model;

    protected bool $withoutGlobalScopes = false;

    protected array $with = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function with(array $with = []): BaseRepository
    {
        $this->with = $with;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function withoutGlobalScopes(): BaseRepository
    {
        $this->withoutGlobalScopes = true;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update(Model $model, array $data): Model
    {
        return tap($model)->update($data);
    }

    /**
     * @inheritdoc
     */
    public function findByFilters(): LengthAwarePaginator
    {
        return $this->model->with($this->with)->paginate();
    }

    /**
     * @inheritdoc
     */
    public function findOneById(int $id): Model
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria): Model
    {
        if (!$this->withoutGlobalScopes) {
            return $this->model->with($this->with)
                ->where($criteria)
                ->orderByDesc('created_at')
                ->firstOrFail();
        }

        return $this->model->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->firstOrFail();
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $modelId): bool
    {
        return $this->model->find($modelId)->delete();
    }

    /**
     * @inheritdoc
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @inheritdoc
     */
    public function existsBy(array $criteria): bool
    {
        return $this->model->where($criteria)->exists();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $criteria): Collection
    {
        return $this->model->where($criteria)->get();
    }
}
