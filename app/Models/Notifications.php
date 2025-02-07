<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        "id","content","user_id",
    ];
    protected $table="notifications";
}