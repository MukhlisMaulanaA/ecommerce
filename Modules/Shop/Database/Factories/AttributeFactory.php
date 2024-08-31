<?php

namespace Modules\Shop\Database\Factories;

use Modules\Shop\App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   */
  protected $model = Attribute::class;

  /**
   * Define the model's default state.
   */
  public function definition(): array
  {
    return [];
  }
}
