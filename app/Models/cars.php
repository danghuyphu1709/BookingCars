<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\services;
use App\Models\type_car;

class cars extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['type_car_id','service_id','code','name','seats_price','seats_quantity','status','created_at','updated_at'];


    // Define the relationship with the Service model
    public function service()
    {
        return $this->belongsTo(services::class, 'service_id');
    }

    // Define the relationship with the TypeCar model
    public function typeCar()
    {
        return $this->belongsTo(type_car::class, 'type_car_id');
    }
}
