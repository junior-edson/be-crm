<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Invoice extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'team_id', 'client_id', 'tax_type', 'tax_rate', 'currency', 'code', 'issue_date', 'due_date',
    ];

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->id = Uuid::uuid4()->toString();
            $invoice->code = $invoice->generateCode();
        });
    }

    /**
     * @return string
     */
    private function generateCode(): string
    {
        $year = now()->year;
        $lastInvoice = self::whereYear('created_at', $year)->where('team_id', Auth::user()->currentTeam->id)->latest('code')->first();
        $sequence = ($lastInvoice) ? intval(substr($lastInvoice->code, 0, 3)) + 1 : 1;
        return sprintf('%03d/%d', $sequence, $year);
    }
}
