<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserKyc extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [
        'user_id',
        'pan_card_img',
        'aadhar_card_front_img',
        'aadhar_card_back_img',
        'passport_img',
        'status',
        'admin_comment',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
