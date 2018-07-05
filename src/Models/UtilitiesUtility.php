<?php
namespace RentalManager\Utilities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use RentalManager\Utilities\Traits\UtilitiesTrait;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 3:48 PM
 * UtilitiesUtility.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class UtilitiesUtility extends Model
{

    use UtilitiesTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;


    /**
     * Model constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('utilities.tables.utilities');
    }
}