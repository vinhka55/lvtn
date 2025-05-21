<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='order';
    public function shipping()
    {
        return $this->belongsTo("App\Models\Shipping");
    }
}
