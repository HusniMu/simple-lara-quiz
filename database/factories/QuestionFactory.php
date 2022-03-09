<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text,
            'answer' => json_encode($this->faker->sentences($nb = 4, $asText = false)),
            'correct_answer' => $this->faker->numberBetween(0, 3),
            'material_id' => 1,
        ];
    }
}