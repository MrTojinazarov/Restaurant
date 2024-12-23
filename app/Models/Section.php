<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ([
        'name',
        'sort',
    ]);

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
