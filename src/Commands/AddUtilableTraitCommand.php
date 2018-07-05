<?php
namespace RentalManager\Utilities\Commands;


use RentalManager\Utilities\Traits\Utilable;
use Traitor\Traitor;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:46 PM
 * AddAmenitablePropertyUseTraitCommand.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class AddUtilableTraitCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rm:add-utilable-trait';

    /**
     * Trait added to User model
     *
     * @var string
     */
    protected $targetTrait = Utilable::class;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $models = $this->getModels();
        foreach ($models as $model) {
            if (!class_exists($model)) {
                $this->error("Class $model does not exist.");
                return;
            }
            if ($this->alreadyUsesTrait($model)) {
                $this->error("Class $model already uses Utilable.");
                continue;
            }
            Traitor::addTrait($this->targetTrait)->toClass($model);
        }
        $this->info("Utilable added successfully to {$models->implode(', ')}");
    }

    /**
     * Check if the class already uses LaratrustUserTrait.
     *
     * @param  string  $model
     * @return bool
     */
    protected function alreadyUsesTrait($model)
    {
        return in_array(Utilable::class, class_uses($model));
    }


    /**
     * Get the description of which clases the LaratrustUserTrait was added.
     *
     * @return string
     */
    public function getDescription()
    {
        return "Add Utilable to {$this->getModels()->implode(', ')} class";
    }
    /**
     * Return the User models array.
     *
     * @return array
     */
    protected function getModels()
    {
        return new Collection([
            Config::get('base.models.unit')
        ]);
    }



}