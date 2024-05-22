<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class road_route extends Model
{
    use HasFactory;

    protected $table = 'road_routes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['code','starting_point_id','destination_point_id','cars_id','kilometer','status','created_at','updated_at'];



    // Define the relationship with the Service model
    public function areStarting()
    {
        return $this->belongsTo(area::class, 'starting_point_id');
    }
    public function aresDestination()
    {
        return $this->belongsTo(area::class, 'destination_point_id');
    }
    // Define the relationship with the TypeCar model
    public function cars()
    {
        return $this->belongsTo(cars::class, 'cars_id');
    }

    protected $dispatchesEvents = [
        'created' => \App\Events\RoadRoute\CreateEvent::class,
        'updated' => \App\Events\RoadRoute\UpdateEvent::class,
    ];
}
