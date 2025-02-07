<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='id';
    protected $table='order_detail';
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
