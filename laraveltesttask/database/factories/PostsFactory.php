<?php

namespace Database\Factories;

use App\Models\Posts;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => $this->faker->numberBetween($min = 1, $max = 15),
            'image_id' => $this->faker->randomElement($array = array (NULL,'1','2','3','4','5')),
            'content' => $this->faker->realText(), // password
            'deleted_at' => $this->faker->randomElement($array = array (NULL, NULL, NULL, NULL, $this->faker->dateTime($max = 'now'))),
            'created_at' => $this->faker->dateTime($max = 'now'),
            'updated_at' => $this->faker->dateTime($max = 'now')
        ];
    }
}
