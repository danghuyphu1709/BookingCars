<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class starting_point extends Model
{
    use HasFactory;

    protected $table = 'starting_points';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['area_id','name','created_at','updated_at'];
}
