<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_child extends Model
{
    use HasFactory;

    protected $table = 'service_children';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['services_id','name','image','status','created_at','updated_at'];
}
