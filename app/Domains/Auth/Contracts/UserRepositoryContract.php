<?php

namespace App\Domains\Auth\Contracts;

use App\Support\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

interface UserRepositoryContract extends RepositoryInterface
{
    public function wherePhone(string $phone): Builder;
}
