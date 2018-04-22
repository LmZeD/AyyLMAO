<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Category extends Model
{
    protected $fillable = ['id', 'parent_id', 'title'];

    /**
     * Setting up relation to parent
     *
     * @return Relation
     */
    public function getParent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    /**
     * Setting up relation to children
     *
     * @return Relation
     */
    public function getChildren()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    /**
     * Setting up relation to children recursively
     *
     * @return Relation
     */
    public function getChildrenRecursive()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')
            ->with('getChildrenRecursive');
    }
}
