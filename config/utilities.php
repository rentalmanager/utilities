<?php
/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 2:03 PM
 * amenities.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | These are the models to define the tables
    | If you want the models to be in a different namespace or
    | to have a different name, you can do it here.
    |
    */
    'models' => [
        /**
         * Utility model
         */
        'utility' => 'App\RentalManager\AddOns\Utility'
    ],

    /*
  |--------------------------------------------------------------------------
  | Tables
  |--------------------------------------------------------------------------
  |
  | These are the tables to store all the necessary data.
  |
  */
    'tables' => [
        /**
         * Utilities table
         */
        'utilities' => 'utilities',
        /**
         * Intermediate table
         */
        'utility_nodes' => 'utility_nodes'
    ],

    /*
   |--------------------------------------------------------------------------
   | Foreign Keys
   |--------------------------------------------------------------------------
   |
   | These are the foreign keys used by propeller in the intermediate tables.
   |
   */
    'foreign_keys' => [
        /**
         * Utility foreign key
         */
        'utility' => 'utility_id'
    ],
];