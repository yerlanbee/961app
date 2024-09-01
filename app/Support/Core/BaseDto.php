<?php

namespace App\Support\Core;

abstract class BaseDto
{
    abstract public static function fromArray(array $data): static;

    abstract public function toArray(): array;
}
