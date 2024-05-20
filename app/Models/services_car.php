<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services_car extends Model
{
    use HasFactory;

    protected $table = 'services_car';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['cars_id','code','name','status','created_at','updated_at'];
}
