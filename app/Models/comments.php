<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['tickets_id','customers_id','content','code','created_at','updated_at'];
}
