<?php
namespace RentalManager\Utilities\Commands;


use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:setup-utilities';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup models and migrations.';


    /**
     * Commands to call with their description.
     *
     * @var array
     */
    protected $calls = [
        'rm:migrate-utilities' => 'Migrate the tables',
        'rm:setup-models-utilities' => 'Setup the models',
    ];

    /**
     * Create a new command instance
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }
    }
}