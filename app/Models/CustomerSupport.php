<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class CustomerSupport extends Model
{
    use HasFactory, Filterable, AsSource;

    protected $fillable = [
        'user_id',
        'subject',
        'category',
        'description',
        'attachment_path',
        'status',
    ];

    protected $allowedFilters = [
        'subject',
        'description',
        'category',
        'status',
    ];

    protected $allowedSorts = [
        'subject',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
