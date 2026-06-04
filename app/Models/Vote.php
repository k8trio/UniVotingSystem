<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
        'candidate_id',
        'position',
        'candidate_name',
        'candidate_college',
    ];
    /**
     * Get the user that cast the vote.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
