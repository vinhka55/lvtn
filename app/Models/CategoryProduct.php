<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryProduct extends Model
{
    use HasFactory;
    use Sluggable;
    public $timestamps=false;
    protected $fillable=[
        'id','name','image','status','slug','created_at',
    ];
    protected $table="category";
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function kinds()
    {
        return $this->hasMany(Kind::class, 'category_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_sports','sport_id', 'user_id');
    }
}
