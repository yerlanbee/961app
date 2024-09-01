<?php

namespace App\Ports\Console\MakeCommands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;

class HandlerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new class handler';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Handler';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private string $handleClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private string $model;

    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws FileNotFoundException
     */
    public function fire(): ?bool
    {
        $path = $this->getPath($this->handleClass);

        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($this->handleClass));

        $this->info($this->type.' created successfully.');

        $this->line("<info>Created Service :</info> $this->handleClass");

        return true;
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return  base_path('stubs/handler.stub');
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Handlers';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class class.'],
        ];
    }
}
