<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class ToDoList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'mark_as_done',
        'priority',
        'ends_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ends_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $appends = [
        'ends_at_diff',
        'badge_color'
    ];

    /**
     * Get the user that owns the to do list.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the to do list.
     */
    public function getEndsAtDiffAttribute()
    {
        if ($this->ends_at) {
            $remaining_days = Carbon::now()->diffInMinutes(Carbon::parse($this->ends_at));
        } else {
            $remaining_days = 0;
        }

        return number_format($remaining_days/60, 1);
    }

    /**
     * Get the user that owns the to do list.
     */
    public function getBadgeColorAttribute()
    {
        return ($this->ends_at_diff < 8) ? "danger" : (($this->ends_at_diff > 8 && $this->ends_at_diff < 24) ? "warning" : "success");
    }
}
