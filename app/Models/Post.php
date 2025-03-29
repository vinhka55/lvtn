<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=[
        "user_id","title","content",'slug','category_id'
    ];
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments() 
    {
        return $this->hasMany(CommentPost::class);
    }
    
}
