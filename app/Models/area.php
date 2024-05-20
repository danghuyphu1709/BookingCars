<?php

namespace App\Models;
use App\Models\city_province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    use HasFactory;
    protected $table = 'areas';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['city_province_id','name','created_at','updated_at'];

    public function CityProvince()
    {
        return $this->belongsTo(city_province::class, 'city_province_id');
    }
}
