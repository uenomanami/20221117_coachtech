<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{

    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'content' => $this->faker->word(),
            'tag_id' => $this->faker->numberBetween(1,5),
            'user_id' => $this->faker->numberBetween(1,1),
        ];
    }
}
