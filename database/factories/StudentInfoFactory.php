<?php

namespace Database\Factories;

use App\Models\StudentInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'age' => $this->faker->word,
        'address' => $this->faker->word,
        'number' => $this->faker->word,
        'gender' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
