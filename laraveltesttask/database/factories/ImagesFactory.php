<?php

namespace Database\Factories;

use App\Models\Images;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Images::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->randomElement($array = array (
                'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg',
                'https://images.unsplash.com/photo-1494548162494-384bba4ab999?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxleHBsb3JlLWZlZWR8NHx8fGVufDB8fHw%3D&w=1000&q=80',
                'https://i.pinimg.com/originals/b5/50/47/b550473ea5cedee8f392fcefa1f4a059.jpg'
            ))
        ];
    }
}
