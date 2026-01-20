<?php

namespace Database\Factories;

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use App\Models\PooEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PooEntry>
 */
class PooEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'occurred_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'consistency' => $this->faker->randomElement([null, ...PooConsistency::values()]),
            'colour' => $this->faker->randomElement([null, ...PooColour::values()]),
            'notes' => $this->faker->optional()->paragraph(),
        ];
    }
}
