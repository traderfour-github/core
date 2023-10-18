<?php

namespace Database\Factories\Trader4\V1;

use App\Models\Trader4\V1\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'slug'  => $this->faker->slug(),
            'icon'  => null,
        ];
    }
}
