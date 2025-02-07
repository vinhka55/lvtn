<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Gallery extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        "id","image","product_id",
    ];
    protected $table="gallery";
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
