<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WettyEvents extends Model
{
    use HasFactory;
    protected $table = 'WettyEvents';
    protected $primaryKey = 'ID';
//    public $timestamps = false;
    const CREATED_AT = 'TimeStamp';
    const UPDATED_AT = 'TimeStamp';

    protected $fillable = [
        'ContainerID',
        'EventType',
        'EventMessage'
    ];
}
