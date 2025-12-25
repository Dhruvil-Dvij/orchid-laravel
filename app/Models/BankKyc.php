<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class BankKyc extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [
        'bank_account_id',
        'passbook_img',
        'status',
        'admin_comment',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }

    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            BankAccount::class,
            'id',        // Foreign key on bank_accounts
            'id',        // Foreign key on users
            'bank_account_id', // Local key on bank_kycs
            'user_id'    // Local key on bank_accounts
        );
    }
}
