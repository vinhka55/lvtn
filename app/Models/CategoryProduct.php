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
        'id','name','status','slug','created_at',
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
}
