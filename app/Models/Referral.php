<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Referral extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'referral_code',
        'used_at',
    ];

    // referrer_user_id refers to the user who made the referral (whose code was used)
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_user_id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
