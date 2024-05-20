<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tickets extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['road_route_id','departure_day_id','ticket_quantity','code','status','created_at','updated_at'];

    public function road_route()
    {
        return $this->belongsTo(road_route::class, 'road_route_id');
    }

    public function departure_day()
    {
        return $this->belongsTo(departure_day::class, 'departure_day_id');
    }
}
