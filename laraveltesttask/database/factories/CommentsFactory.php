<?php

namespace Database\Factories;

use App\Models\Comments;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'commentator_id' => $this->faker->numberBetween($min = 1, $max = 15),
            'post_id' => $this->faker->numberBetween($min = 1, $max = 30),
            'content' => $this->faker->realText(), // password
            'deleted_at' => $this->faker->randomElement($array = array (NULL, NULL, NULL, NULL, $this->faker->dateTime($max = 'now'))),
            'created_at' => $this->faker->dateTime($max = 'now'),
            'updated_at' => $this->faker->dateTime($max = 'now')
        ];
    }
}
