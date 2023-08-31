<?php

namespace Database\Factories;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Role::class;

    public function definition()
    {
        $name = ucfirst($this->faker->unique()->word);
        $nameSlug = Str::slug($name);
        return [
            'name' => $name,
            'name_slug' => $nameSlug,
            'is_active' => 0,
        ];
    }
}
