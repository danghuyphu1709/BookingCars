<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;




class roles extends Model
{
    use HasFactory;

    use HasRoles;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['name','guard_name','created_at','updated_at'];

}
