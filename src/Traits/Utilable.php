<?php
namespace RentalManager\Utilities\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RentalManager\RelationHelper\Facades\RelationHelper;
use InvalidArgumentException;

/**
 * Created by PhpStorm.
 * Date: 7/3/18
 * Time: 3:48 PM
 * Utilable.php
 * @author Goran Krgovic <goran@dashlocal.com>
 */

trait Utilable
{

    /**
     * Where utilities are
     *
     * @param $query
     * @param array $utilities
     * @return mixed
     */
    public function scopeWhereUtilitiesAre($query, $utilities = [])
    {
        return $query->whereHas('utilities', function($utilityQuery) use ( $utilities ) {
            $utilityQuery->whereIn('id', $utilities);
        });
    }


    /**
     * @param $utility
     * @return $this
     */
    public function attachUtility($utility)
    {
        return $this->attachUtilableModel('utilities', $utility);
    }

    /**
     * @param array $utilities
     * @return $this
     */
    public function attachUtilities($utilities = [])
    {
        foreach ( $utilities as $utility )
        {
            $this->attachUtility($utility);
        }
        return $this;
    }

    /**
     * @param $utility
     * @return static
     */
    public function detachUtility($utility)
    {
        return $this->detachUtilableModel('utilities', $utility);
    }

    /**
     * @param array $utilities
     * @return $this
     */
    public function detachUtilities($utilities = [])
    {
        if (empty( $utilities ) ) {
            $utilities = $this->utilities()->get();
        }

        foreach ( $utilities as $utility )
        {
            $this->detachUtility($utility);
        }
        return $this;
    }

    /**
     * @param $utilities
     * @param bool $detaching
     * @return $this
     */
    public function syncUtilities($utilities, $detaching = true)
    {
        return $this->syncUtilableModels('utilities', $utilities, $detaching);
    }

    /**
     * @param $utilities
     * @return $this
     */
    public function syncUtilitiesWithoutDetaching($utilities)
    {
        return $this->syncUtilities($utilities, false);
    }

    /**
     * @return mixed
     */
    public function utilities()
    {
        return $this->morphToMany(
            Config::get('utilities.models.utility'), // model
            'node', // node
            Config::get('utilities.tables.utility_nodes'), // table
            'node_id',
            Config::get('utilities.foreign_keys.utility')
        );
    }

    // ALIASES
    // ---------------------------

    /**
     * Alias to eloquent attach() method
     *
     * @param $relationship
     * @param $object
     * @return $this
     */
    private function attachUtilableModel($relationship, $object)
    {
        if ( !RelationHelper::isValidRelationship($relationship) )
        {
            throw new InvalidArgumentException;
        }

        $attributes = [];
        $objectType = Str::singular($relationship);
        $object = RelationHelper::getIdFor($object, $objectType);

        $this->$relationship()->attach(
            $object,
            $attributes
        );

        return $this;
    }

    /**
     * Alias to eloquent many-to-many relation's detach() method
     *
     * @param string $relationship
     * @param mixed $object
     * @return static
     */
    private function detachUtilableModel($relationship, $object)
    {
        if ( !RelationHelper::isValidRelationship($relationship) )
        {
            throw new InvalidArgumentException;
        }

        $objectType = Str::singular($relationship);
        $relationshipQuery = $this->$relationship();

        $object = RelationHelper::getIdFor($object, $objectType);

        $relationshipQuery->detach($object);

        return $this;
    }

    /**
     * Alias to eloquent sync() method
     *
     * @param $relationship
     * @param $objects
     * @param bool $detaching
     * @return $this
     */
    public function syncUtilableModels($relationship, $objects, $detaching = true)
    {
        if ( !RelationHelper::isValidRelationship($relationship) )
        {
            throw new InvalidArgumentException;
        }

        $objectType = Str::singular($relationship);
        $mappedObjects = [];

        foreach ( $objects as $object )
        {
            $mappedObjects[] = RelationHelper::getIdFor($object, $objectType);
        }

        $relationshipToSync = $this->$relationship();

        $result = $relationshipToSync->sync($mappedObjects, $detaching);

        return $this;
    }

}