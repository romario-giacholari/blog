<?php

namespace App\Adapters\Post;

use App\Entities\Post\PostEntity;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;
use stdClass;

class PostAdapter
{

    public static function toPost(PostEntity $postEntity): Post
    {
        $post = new Post();
        $post->id = $postEntity->id;
        $post->user_id = $postEntity->userId ?? null;
        $post->title = $postEntity->title;
        $post->body = $postEntity->body;
        $post->slug = $postEntity->slug;
        $post->excerpt = $postEntity->excerpt;
        $post->views = $postEntity->views;
        $post->created_at = $postEntity->created_at;
        $post->updated_at = $postEntity->updated_at;

        return $post;
    }

    public static function toPostEntity(object $postData): PostEntity
    {
        $postEntity = new PostEntity();
        $postEntity->id = $postData->id;
        $postEntity->userId = $postData->user_id;
        $postEntity->title = $postData->title;
        $postEntity->body = $postData->body;
        $postEntity->slug = $postData->slug;
        $postEntity->excerpt = $postData->excerpt;
        $postEntity->views = $postData->views;
        $postEntity->created_at = Carbon::parse($postData->created_at);
        $postEntity->updated_at = Carbon::parse($postData->updated_at);

        return $postEntity;
    }

    public static function toPostData(PostEntity $postEntity): object
    {
        $postData = new stdClass();
        $postData->userId = $postEntity->userId ?? null;
        $postData->title = $postEntity->title;
        $postData->body = $postEntity->body;
        $postData->slug = Str::slug($postEntity->title, '-');
        $postData->excerpt = strip_tags(Str::limit($postEntity->body, 100, ' ...'));
        $postData->views = $postEntity->views;
        $postData->created_at = $postEntity->created_at->toDateTimeString();
        $postData->updated_at = $postEntity->updated_at->toDateTimeString();

        return $postData;
    }
}
