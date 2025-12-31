<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'mobile_number',
        'password',
        'referral_code',
        'referred_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'         => Where::class,
        'customer_id' => Like::class,
        'name'       => Like::class,
        'email'      => Like::class,
        'mobile_number' => Like::class,
        'referral_code' => Like::class,
        'referred_by' => Where::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'customer_id',
        'name',
        'email',
        'mobile_number',
        'referral_code',
        'referred_by',
        'updated_at',
        'created_at',
    ];

    /**
     * Generate a unique referral code for the user.
     */
    public function generateReferralCode(): string
    {
        do {
            $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            do {
                // Decide counts
                $numbersCount = rand(2, 3);
                $lettersCount = 6 - $numbersCount; // 3 or 4, but we will limit later

                // Ensure letters are also between 2–3
                if ($lettersCount > 3) {
                    $lettersCount = 3;
                    $numbersCount = 3;
                }

                // Generate parts
                $numbers = collect(range(0, 9))->random($numbersCount)->implode('');
                $letters = collect(range('A', 'Z'))->random($lettersCount)->implode('');

                // Shuffle and build final ID
                $customerId = collect(str_split($numbers . $letters))
                    ->shuffle()
                    ->implode('');
            } while (
                strlen($customerId) !== 6 ||
                self::where('customer_id', $customerId)->exists()
            );

            $user->customer_id = $customerId;
        });
    }

    public function fund(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function basketPurchases()
    {
        return $this->hasMany(BasketPurchase::class);
    }

    public function kycSubmission()
    {
        return $this->hasOne(KycSubmission::class);
    }

    public function basketWithdrawals()
    {
        return $this->hasMany(BasketWithdrawal::class);
    }

    public function walletWithdrawals()
    {
        return $this->hasMany(WalletWithdrawal::class);
    }

    public function userKyc()
    {
        return $this->hasOne(UserKyc::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function primaryBankAccount()
    {
        return $this->hasOne(BankAccount::class)
            ->where('is_primary', true);
    }

    public function referralsMade()
    {
        return $this->hasMany(Referral::class, 'referrer_user_id');
    }

    public function referredBy()
    {
        return $this->hasOne(Referral::class, 'referred_user_id');
    }
}
