<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_title',
        'slug',
        'cover_image',
        'category',
        'body',
        'tags',
        'excerpt',
        'meta_description',
        'read_time_minutes',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at'      => 'datetime',
        'is_published'      => 'boolean',
        'read_time_minutes' => 'integer',
        'tags'              => 'array',
    ];

    /**
     * Scope: only published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Scope: filter by category.
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: latest first.
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Get the cover image URL.
     */
    public function getCoverImageUrlAttribute(): string
    {
        $path = $this->cover_image;
        
        if (!$path) {
            return asset('images/news/placeholder.jpg');
        }

        if (str_starts_with($path, '[') && str_ends_with($path, ']')) {
            $decoded = json_decode($path, true);
            if (is_array($decoded) && count($decoded) > 0) {
                $path = $decoded[0];
            }
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return asset('storage/' . ltrim($path, '/'));
    }

    /**
     * Get formatted published date.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->format('M d, Y')
            : 'Draft';
    }

    /**
     * Get related posts (same category, excluding self).
     */
    public function relatedPosts(int $limit = 3)
    {
        return static::published()
            ->where('category', $this->category)
            ->where('id', '!=', $this->id)
            ->latestFirst()
            ->limit($limit)
            ->get();
    }

    /**
     * Get SEO Title (falls back to regular title).
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    /**
     * Get SEO Description (falls back to regular excerpt).
     */
    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: $this->excerpt;
    }

    /**
     * Get tags as a clean array (always returns an array, never null).
     */
    public function getTagsListAttribute(): array
    {
        return $this->tags ?? [];
    }

    /**
     * Get the route key name for route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
