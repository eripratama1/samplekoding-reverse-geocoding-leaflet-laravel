<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    protected $guarded = [];

    /** Relation table */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /** Accessor image */
    public function getImagePath()
    {
        if ($this->image_path) {
            return $this->image_path;
        }

        return'https://placehold.co/600x400?text=No+Image';
    }
}
