<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    protected $fillable=[
        'id','order_date','sales','profit','quantity','total_order'
    ];
    public $timestamps = false;
    protected $table='statistical';
}
