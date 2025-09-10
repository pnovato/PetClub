<?php


namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = \App\Models\Pet::class;
    public function definition(): array
    {
        $species = $this->faker->randomElement(['dog','cat']);
        return [
            'name'        => $species === 'dog' ? $this->faker->firstName() : $this->faker->lastName(),
            'species'     => $species,
            'sex'         => $this->faker->randomElement(['male','female']),
            'age_years'   => $this->faker->numberBetween(0, 14),
            'size'        => $this->faker->randomElement(['small','medium','large']),
            'image'       => $species === 'dog' ? 'dog'.rand(1,3).'.jpg' : 'cat'.rand(1,3).'.jpg',
            'description' => $this->faker->sentence(12),
            'status'      => 'available', // default
        ];
    }
}

