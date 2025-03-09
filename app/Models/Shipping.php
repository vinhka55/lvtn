<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'phone', 'address', 'notes', 'pay_method',];
    protected $primaryKey='id';
    protected $table='shipping';
    
}
