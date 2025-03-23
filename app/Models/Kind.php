<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id']; // Các trường có thể điền

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
     // Quan hệ: Một loại có thể có nhiều sản phẩm
     public function products()
     {
         return $this->hasMany(Product::class, 'kind_id');
     }
}
