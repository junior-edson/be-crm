<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaEvent extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'client_id',
        'event_datetime',
        'address',
        'description',
    ];
}
