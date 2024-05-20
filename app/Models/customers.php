<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['users_id ','name','email','phone','avatar','created_at','updated_ad'];
}
