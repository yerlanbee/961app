<?php

namespace App\Support\Core;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Support\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    abstract public function getQueryBuilder(): Builder;

    /**
     * @param int $id
     * @return Model|Collection|array
     */
    public function findOne(int $id): Model|Collection|array
    {
        return $this->getQueryBuilder()->find($id);
    }

    /**
     * @param  array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        return $this->getQueryBuilder()->insert($data);
    }

    /**
     * @param array $data
     * @return Model|Collection|array
     */
    public function create(array $data): Model|Collection|array
    {
        return $this->getQueryBuilder()->create($data);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool|int
     */
    public function update(array $attributes, int $id): bool|int
    {
        return $this->getQueryBuilder()->find($id)->update($attributes);
    }

    /**
     * @return Model|Collection|array
     */
    public function all(): Model|Collection|array
    {
        return $this->getQueryBuilder()->get();
    }

    /**
     * @param int $id
     * @return bool|int
     */
    public function deleteOne(int $id): bool|int
    {
        return $this->getQueryBuilder()->delete();
    }

    /**
     * @return void
     */
    public function deleteAll(): void
    {
        $this->getQueryBuilder()->truncate();
    }

    /**
     * @param int $id
     * @return Model|Collection|array
     */
    public function findOneOrFail(int $id): Model|Collection|array
    {
        return $this->getQueryBuilder()->findOrFail($id);
    }
}
