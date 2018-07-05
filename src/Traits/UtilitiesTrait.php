<?php
namespace RentalManager\Utilities\Traits;

use Illuminate\Support\Facades\Config;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 3:48 PM
 * UtilitiesTrait.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

trait UtilitiesTrait
{

    /**
     * Morphed by many
     * @param $relationship
     * @return mixed
     */
    public function getMorphByRelation($relationship)
    {
        return $this->morphedByMany(
            Config::get('utilities.models')[$relationship],
            'node',
            Config::get('utilities.tables.utility_nodes'),
            Config::get('utilities.foreign_keys.utility'),
            'node_id'
        );
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!preg_match('/^can[A-Z].*/', $method)) {
            return parent::__call($method, $parameters);
        }
    }
}