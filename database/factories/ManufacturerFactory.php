<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Manufacturer $manufacturer) {
            File::factory()->count(2)->create(['manufacturer_id' => $manufacturer->id]);
        });
    }
}
