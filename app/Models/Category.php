<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getIconMarker()
    {
        if ($this->icon) {
            return $this->icon;
        }

        return;
    }
}
