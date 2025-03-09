<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'matp','maqh','xaid','money',
    ];
    protected $primaryKey = 'id';
    protected $table="feeship";
    public function city()
    {
        return $this->belongsTo(City::class, 'matp', 'matp');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'maqh', 'maqh');
    }

    public function wards()
    {
        return $this->belongsTo(Wards::class, 'xaid', 'xaid');
    }
}
