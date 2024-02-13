<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; 

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'price', 'description', 'url'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByPrice', function (Builder $builder) {
            $builder->orderBy('price', 'desc');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
