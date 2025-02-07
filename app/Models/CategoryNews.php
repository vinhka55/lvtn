<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryNews extends Model
{
    use HasFactory;
    use Sluggable;
    public $timestamps=false;
    protected $fillable=[
        'name','description','status','slug',
    ];
    protected $table="category_news";
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
