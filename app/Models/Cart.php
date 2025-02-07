<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Cart extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'id','values_cart','user_id',
    ];
    protected $table="cart";
}
