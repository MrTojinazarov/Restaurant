<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'section_id',
        'salary_type',
        'salary',
        'bonus',
        'workhours',
        'start_time',
        'end_time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
