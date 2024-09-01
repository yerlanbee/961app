<?php
declare(strict_types=1);

namespace App\Support\Core;

use Illuminate\Bus\Dispatcher;
use App\Support\Interfaces\CommandBusContract;
use App\Support\Interfaces\CommandContract;

final class CustomCommandBus implements CommandBusContract
{
    public function __construct(private Dispatcher $bus)
    {}

    /**
     * @param CommandContract $command
     * @return mixed
     */
    public function dispatch(CommandContract $command): mixed
    {
        return $this->bus->dispatch($command);
    }

    /**
     * @param array $map
     * @return void
     */
    public function map(array $map): void
    {
        $this->bus->map($map);
    }
}
