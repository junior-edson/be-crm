<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Client extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'team_id',
        'name',
        'type',
        'registration_code',
        'tax_type',
        'address',
        'phone',
        'email',
        'is_npo',
        'is_building_older_than_10_years',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
            $model->team_id = Auth::user()->currentTeam->id;
        });
    }

    /**
     * @return HasMany
     */
    public function agendaEvents(): HasMany
    {
        return $this->hasMany(AgendaEvent::class);
    }
}
