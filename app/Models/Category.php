<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ([
        'name',
        'sort'
    ]);

    public function food()
    {
        return $this->hasMany(Food::class);
    }
}
