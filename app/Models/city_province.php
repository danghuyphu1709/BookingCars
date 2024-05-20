<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city_province extends Model
{
    use HasFactory;

    protected $table = 'city_provinces';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['name','created_at','updated_at'];
}
