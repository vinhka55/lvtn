<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='coupon';
    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
}
