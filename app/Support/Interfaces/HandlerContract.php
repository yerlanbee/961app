<?php

namespace App\Support\Interfaces;

use App\Support\Core\BaseDto;

interface HandlerContract
{
    /**
     * @param BaseDto $dto
     * @return mixed
     */
    public function handle(BaseDto $dto): mixed;
}
