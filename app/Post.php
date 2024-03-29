<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * Class Post.
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $title
 * @property string $body
 * @property string $slug
 * @property string $excerpt
 * @property int    $views
 * @property Carbon|mixed created_at
 * @property Carbon|mixed updated_at
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'slug', 'excerpt', 'views',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path(): string
    {
        return "posts/{$this->slug}";
    }

    public function setSlugAttribute(string $title): void
    {
        $this->attributes['slug'] = Str::slug($title, '-');
    }

    public function setExcerptAttribute(string $excerpt): void
    {
        $output = strip_tags(Str::limit($excerpt, 100, ' ...'));

        $this->attributes['excerpt'] = $output;
    }

    public function setBodyAttribute(string $body): void
    {
        $this->attributes['body'] = preg_replace(
            '/@([\w\-]+)/',
            '<a href="/$1">$0</a>',
            $body
        );
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
