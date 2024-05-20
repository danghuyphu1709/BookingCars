<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departure_day extends Model
{
    use HasFactory;

    protected $table = 'departure_days';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['code','preparation_time','departure_time','status','created_at','updated_at'];
}
