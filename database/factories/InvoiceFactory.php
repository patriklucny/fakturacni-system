<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => "2022-" . $this->faker->unique()->numberBetween($min = 1000, $max = 1011),
            'supplier_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'subscriber_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'create_date' => $this->faker->dateTimeBetween('-2 months', '-1 month'),
            'due_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
