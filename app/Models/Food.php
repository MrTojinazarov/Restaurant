<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
        protected $fillable = ([
            'name',
            'category_id',
            'price',
            'img',
        ]);
    
        public function category()
        {
            return $this->belongsTo(Category::class, 'category_id');
        }

        public function orderItem()
        {
            return $this->hasMany(OrderItems::class);
        }
}
