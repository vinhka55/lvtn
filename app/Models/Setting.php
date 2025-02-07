<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=[
        'name','email','phone','address','tax','logo',
    ];
    protected $table='setting';
} 
