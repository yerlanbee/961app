<?php
declare(strict_types=1);

namespace App\Support\Interfaces;

interface CommandHandlerContract
{
    public function handle(CommandContract $command): mixed;
}
