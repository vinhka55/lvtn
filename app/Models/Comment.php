<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'id','content','name_user_comment','time','product_id'
    ];
    protected $primaryKey='id';
    protected $table='comment';
    public function product()
    {
        return $this->belongsTo("App\Models\Product");
    }
} 
