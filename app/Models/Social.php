<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable=[
        'provider_user_id','provider','login_id'
    ];
    public $timestamps = false;
    protected $primaryKey='id';
    protected $table='social';
    public function login(){
        return $this->belongsTo('App\Models\User');
    }
}
