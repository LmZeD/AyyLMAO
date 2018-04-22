<?php

namespace App\Traits;

trait FlattenArrayTrait {

    /**
     * @param $treeArray
     *
     * @return array
     */
    function flatten($treeArray) {
        $return = [];
        array_walk_recursive($treeArray, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
}