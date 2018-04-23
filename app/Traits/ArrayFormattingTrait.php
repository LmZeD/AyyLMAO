<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait ArrayFormattingTrait
{

    /**
     * Flattens tree array
     *
     * @param array $treeArray
     *
     * @return array
     */
    function flatten($treeArray): array
    {
        $flat = [];
        array_walk_recursive($treeArray, function ($a) use (&$flat) {
            $flat[] = $a;
        });
        return $flat;
    }

    /**
     * Merges collections to array
     *
     * @param array $collectionArray
     *
     * @return array
     */
    function mergeCollectionsArray($collectionArray): array
    {
        $merged = [];
        foreach ($collectionArray as $collection) {
            $array = $collection->toArray();
            $merged = array_merge($array, $merged);
        }
        return $merged;
    }
}