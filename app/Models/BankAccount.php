<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class BankAccount extends Model
{
    use HasFactory, Filterable, AsSource;
    
    protected $fillable = [
        'user_id',
        'bank_account_holder',
        'bank_account_number',
        'bank_ifsc',
        'bank_name',
        'upi_id',
        'qr_code_img',
        'is_primary',
        'created_by',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bankKyc(): HasOne
    {
        return $this->hasOne(BankKyc::class, 'bank_account_id');
    }
}
