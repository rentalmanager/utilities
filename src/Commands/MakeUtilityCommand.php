<?php
namespace RentalManager\Utilities\Commands;


use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

class MakeUtilityCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:utility';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Utility model if it does not exist';


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Utility model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__. '/../../stubs/utility.stub';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return Config::get('utilities.models.utility', 'Utility');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }
}