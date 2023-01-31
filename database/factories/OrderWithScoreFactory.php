<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderWithScore>
 */
class OrderWithScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => 12345,
            'client_id' => 54321,
        	'items' => [
                ['article' => '3005-12', 'name' => "Сосиска в тесте", 'price' => 100, 'quantity' => 12],
                ['article' => '3005-13', 'name' => "Дырка от бублика", 'price' => 340, 'quantity' => 3],
                ['article' => '3005-14', 'name' => "Усы Фредди Меркьюри", 'price' => 900, 'quantity' => 90],
            ],
        	'status' => 'new',
            'scores' => 9,
        ];
    }
}
