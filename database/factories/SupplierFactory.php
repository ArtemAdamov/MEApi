<?php

namespace Database\Factories;

use App\Models\File;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'actual_address' => $this->faker->address,
            'legal_address' => $this->faker->address
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Supplier $supplier) {
            File::factory()->count(2)->create(['supplier_id' => $supplier->id]);

            Manufacturer::factory()->count(2)->create()->each(function($manufacturer) use ($supplier) {
                DB::table('manufacturer_supplier')->insert(['manufacturer_id' => $manufacturer->id, 'supplier_id' => $supplier->id]);
            });
        });
    }
}
