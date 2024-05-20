<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tickets_booked extends Model
{
    use HasFactory;

    protected $table = 'ticket_booked';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $fillable = ['tickets_id','customers_id','payment_id','code','seats_price','ticket_quantity','status','created_at','updated_at'];
}
