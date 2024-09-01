<?php

namespace App\Support\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Контракт для работы с Repository.
 */
interface RepositoryInterface
{
    /**
     * @param int $id
     * @return Model|array|Collection
     */
    public function findOne(int $id): Model|Collection|array;

    /**
     * @param array $data
     * @return Model|array|Collection
     */
    public function create(array $data): Model|Collection|array;

    /**
     * @param  array $data
     * @return bool
     */
    public function insert(array $data): bool;

    /**
     * @param array $attributes
     * @param int $id
     * @return bool|int
     */
    public function update(array $attributes, int $id): bool|int;

    /**
     * @return Model|Collection|array
     */
    public function all(): Model|Collection|array;

    /**
     * @param int $id
     * @return bool|int
     */
    public function deleteOne(int $id): bool|int;

    /**
     * @return void
     */
    public function deleteAll(): void;

    /**
     * @param int $id
     * @return Model|Collection|array
     */
    public function findOneOrFail(int $id): Model|Collection|array;
}
