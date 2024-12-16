<?php

namespace App\Models;

use Carbon\Carbon;
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
        'time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function attendence()
    {
        return $this->hasOne(Attendence::class);
    }

    public function checks($date)
    {
        return $this->attendence()->where('date', Carbon::parse($date))->first();
    }
}
