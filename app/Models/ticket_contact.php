<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket_contact extends Model
{
    use HasFactory;

    protected $table = 'ticket_contact';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['name','email','phone','note','created_at','updated_at'];
}
