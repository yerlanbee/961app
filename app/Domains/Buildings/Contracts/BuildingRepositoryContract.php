<?php

namespace App\Domains\Buildings\Contracts;

use App\Support\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface BuildingRepositoryContract extends RepositoryInterface
{
    public function findWithRelations(int $id, array $relations): Model;
}
