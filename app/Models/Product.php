<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='product';
    protected $dates = ['exp'];
    public function comment()
    {
        return $this->hasMany("App\Models\Comment");
    }
    public function category()
    {
        return $this->belongsTo("App\Models\CategoryProduct");
    }
    public function sizes()
    {
        return $this->hasMany("App\Models\ProductSize");
    }
    // Quan hệ: Mỗi sản phẩm thuộc về một loại (Kind)
    public function kind()
    {
        return $this->belongsTo(Kind::class, 'kind_id');
    }

}
