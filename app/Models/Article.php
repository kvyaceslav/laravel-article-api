<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public const STATUSES = [
        'active' => 'active',
        'inactive' => 'inactive',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'content',
        'status',
    ];

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeGetActive(Builder $builder): Builder
    {
        return $builder->where('status', self::STATUSES['active']);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeGetOlder(Builder $builder): Builder
    {
        // NOTE: Here need to modify date!!!

        return $builder
            ->where(
                'created_at',
                '<',
                Carbon::now()->subDay()->toDateTimeString()
            );
    }
}
