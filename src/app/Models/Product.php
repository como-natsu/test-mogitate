<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','price','image','description'];

    public function seasons()
{
    return $this->belongsToMany(Season::class,'product_season');
}

public function scopeProductSearch($query, $name)
{
    if (!empty($name)) {
    return $query->where('name', 'like', '%' . $name . '%');

    }
    return $query;
}

}

