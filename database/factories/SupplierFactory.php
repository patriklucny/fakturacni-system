<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->safeEmail(),
            'id_number' => $this->faker->randomNumber($nbDigits = 8, $strict = true),
            'tax_number' => "CZ" . $this->faker->randomNumber($nbDigits = 8, $strict = true),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
