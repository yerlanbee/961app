<?php

namespace App\Support\Interfaces;

interface CommandBusContract
{
    /**
     * @param CommandContract $command
     * @return mixed
     */
    public function dispatch(CommandContract $command): mixed;

    /**
     * @param array<class-string<CommandContract>,class-string<CommandHandlerContract>> $map
     * @return void
     */
    public function map(array $map): void;
}
