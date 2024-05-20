<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['user_id','role_id','name','date_of_birth','identity_id','avatar','created_at','updated_at'];

}
