<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgendaEvent extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'client_id',
        'name',
        'initial_date',
        'final_date',
        'initial_time',
        'final_time',
        'address',
        'description',
    ];

    protected $hidden = [
        'client_id',
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
