<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'location',
        'salary',
        'lowball_score',
        'lowball_label',
        'strategy',
        'rebuttals',
        'warnings',
        'phone_script',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'lowball_score' => 'integer',
        'rebuttals' => 'array',
        'warnings' => 'array',
    ];

    /**
     * Get the user that owns this saved offer.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the color class for the lowball meter.
     */
    public function getLowballColorAttribute(): string
    {
        return match (true) {
            $this->lowball_score >= 70 => 'bg-primary',
            $this->lowball_score >= 40 => 'bg-yellow-500',
            default => 'bg-red-500',
        };
    }

    /**
     * Get the text color class for the lowball label.
     */
    public function getLowballTextColorAttribute(): string
    {
        return match (true) {
            $this->lowball_score >= 70 => 'text-primary',
            $this->lowball_score >= 40 => 'text-yellow-500',
            default => 'text-red-500',
        };
    }
}
