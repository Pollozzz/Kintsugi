<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]

class Category extends Model
{
    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisement::class);
    }
}
