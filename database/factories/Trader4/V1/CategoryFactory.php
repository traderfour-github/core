<?php

namespace Database\Factories\Trader4\V1;

use App\Enums\V1\Category\Type;
use App\Models\Trader4\V1\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trader4\V1\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'slug'  => $this->faker->slug(),
            'icon'  => null,
            'type'  => array_rand(Type::toArray()),
            'parent_id'  => null,
        ];
    }
}
