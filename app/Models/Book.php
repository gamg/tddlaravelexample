<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    // Accessor
    public function getTitleAttribute($value): string
    {
        return strtoupper($value);
    }

    // Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower(trim($value));
    }
}
