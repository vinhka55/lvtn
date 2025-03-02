<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'size', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
