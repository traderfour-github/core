<?php

namespace Database\Factories\Trader4\V1\Post;

use App\Enums\V1\Post\Comment;
use App\Enums\V1\Post\Status;
use App\Enums\V1\Post\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Trader4\V1\Post::class;

    public function definition()
    {
        return [
            'user_id' => str()->uuid()->toString(),
            'title' => $this->faker->word(),
            'slogan'  => $this->faker->slug(),
            'excerpt'  => $this->faker->sentence(10),
            'content'  => $this->faker->sentence(10),
            'comments'  => Comment::PUBLIC->value,
            'type'  => Type::ARTICLE->value,
            'is_public'  => true,
            'is_featured'  => false,
            'is_pinned'  => false,
            'for_kids'  => false,
            'last_update'  => now()->toDateTimeString(),
            'published_at'  => now()->toDateTimeString(),
            'status'  => Status::Active->value,
        ];
    }
}
