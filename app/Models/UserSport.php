<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSport extends Model
{
    use HasFactory;
    protected $table='user_sports';
    protected $fillable = ['user_id', 'sport_id'];
    public $timestamps = false;
    public function sport()
    {
        return $this->belongsTo(CategoryProduct::class, 'sport_id', 'id');
    }
}
