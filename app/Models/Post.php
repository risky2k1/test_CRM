<?php

namespace App\Models;

use App\Enums\PostStatusEnum;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $status
 */
class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'title',
        'status',
        'content',
        "slug",
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusNameAttribute(): string
    {
        return PostStatusEnum::getKeys($this->status)[0];
    }
}
