<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = ([
        'employee_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'time',
    ]);

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
