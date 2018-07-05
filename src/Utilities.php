<?php
namespace RentalManager\Utilities;
/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 4:01 PM
 * Utilities.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

class Utilities
{
    /**
     * Laravel application.
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;


    /**
     * Base constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
}