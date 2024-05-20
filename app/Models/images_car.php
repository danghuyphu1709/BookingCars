<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images_car extends Model
{
    use HasFactory;

    protected $table = 'images_car';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['cars_id','code','name','image','status','created_at','updated_at'];
}
