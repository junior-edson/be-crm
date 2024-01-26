<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Proposal extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['team_id', 'client_id', 'tax_type', 'currency', 'code', 'valid_until', 'items'];
    protected $casts = [
        'valid_until' => 'date',
        'items' => 'array',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($proposal) {
            $proposal->id = Uuid::uuid4()->toString();
            $proposal->code = $proposal->generateCode();
        });
    }

    /**
     * @return string
     */
    private function generateCode(): string
    {
        $year = now()->year;
        $lastProposal = self::whereYear('created_at', $year)->where('team_id', Auth::user()->currentTeam->id)->latest('code')->first();
        $sequence = ($lastProposal) ? intval(substr($lastProposal->code, 0, 3)) + 1 : 1;
        return sprintf('%03d/%d', $sequence, $year);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ProposalItem::class);
    }
}
