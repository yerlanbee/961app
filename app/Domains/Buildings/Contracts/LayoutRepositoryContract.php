<?php

namespace App\Domains\Buildings\Contracts;

use App\Support\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

interface LayoutRepositoryContract extends RepositoryInterface
{
    public function whereBuildingId(int $id): Builder;
}
