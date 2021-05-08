<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Accessor
    public function getNameAttribute($value): string
    {
        return strtoupper($value);
    }

    // Mutator
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim(strtolower($value));
    }
}
