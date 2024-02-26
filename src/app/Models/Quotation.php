<?php

namespace App\Models;

use App\Enums\EnumQuotationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Quotation extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'team_id',
        'client_id',
        'number',
        'issue_date',
        'due_date',
        'client_name',
        'client_email',
        'client_address',
        'company_name',
        'company_email',
        'company_address',
        'tax_type',
        'currency',
        'notes',
        'status'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($quotation) {
            $quotation->id = Uuid::uuid4()->toString();
            $quotation->team_id = Auth::user()->currentTeam->id;
            $quotation->user_id = Auth::id();

            if (self::isPending($quotation)) {
                $quotation->number = $quotation->generateNumber();
            }
        });

        static::updating(function ($quotation) {
            if (self::isPending($quotation)) {
                $quotation->number = $quotation->generateNumber();
            }
        });
    }

    /**
     * @param $quotation
     * @return bool
     */
    private static function isPending($quotation): bool
    {
        return $quotation->status === EnumQuotationStatus::PENDING->value;
    }

    /**
     * @return string
     */
    private function generateNumber(): string
    {
        $year = now()->year;
        $lastQuotation = self::whereYear('created_at', $year)->where('team_id', Auth::user()->currentTeam->id)->latest('number')->first();
        $sequence = ($lastQuotation) ? intval(substr($lastQuotation->number, 0, 3)) + 1 : 1;
        return sprintf('%03d/%d', $sequence, $year);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
