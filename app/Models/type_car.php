<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_car extends Model
{
    use HasFactory;

    protected $table = 'type_cars';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['code','name','status','created_at','updated_at'];
}
