<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public $fillable = ['name','image','status','created_at','updated_at'];

    protected $dispatchesEvents = [
        'created' => \App\Events\Service\CreateEvent::class,
        'updated' => \App\Events\Service\UpdateEvent::class,
    ];
}
