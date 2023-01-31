<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class OrderWithScoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->apiResponce = '{"client_id":54321,"scores":9,"order_id":12345}';
        $this->body = [
            "id" => 12345,
            "client_id" => 54321,
            "items" => [
                [
                    "article" => "3005-12",
                    "name" => "Сосиска в тесте",
                    "price" => 100,
                    "quantity" => 12
                ],
                [
                    "article" => "3005-13",
                    "name" => "Дырка от бублика",
                    "price" => 340,
                    "quantity" => 3
                ],
                [
                    "article" => "3005-14",
                    "name" => "Усы Фредди Меркьюри",
                    "price" => 900,
                    "quantity" => 90
                ]
            ],
            "status" => "new"
        ];

        $this->body2 = $this->body;
        $this->body2['items'][] = [
            "article" => "3005-35",
            "name" => "Новый товар",
            "price" => 900,
            "quantity" => 90
        ];
        $this->apiResponce2 = '{"client_id":54321,"scores":549,"order_id":12345}';

        $this->body3 = $this->body;
        $this->body3['id'] = 22222;
        $this->apiResponce3 = '{"client_id":54321,"scores":9,"order_id":22222}';
    }

    public function testApiCreateAndUpdateOneFieldInDataBase()
    {
        $this->assertDatabaseCount('order_with_scores', 0);

        $route = route('api');

        $response = $this->json('POST', $route, $this->body);
        $response2 = $this->json('POST', $route, $this->body2);

        $response->assertStatus(Response::HTTP_OK);
        $response2->assertStatus(Response::HTTP_OK);

        $this->assertEquals($response->content(), $this->apiResponce);
        $this->assertEquals($response2->content(), $this->apiResponce2);

        $this->assertDatabaseCount('order_with_scores', 1);

        $this->assertDatabaseHas(
            'order_with_scores',
            ["order_id" => 12345, "client_id" => 54321],
        );
    }

    public function testApiCreateTwoFieldInDatabase()
    {
        $this->assertDatabaseCount('order_with_scores', 0);

        $route = route('api');

        $response = $this->json('POST', $route, $this->body);
        $response2 = $this->json('POST', $route, $this->body3);

        $response->assertStatus(Response::HTTP_OK);
        $response2->assertStatus(Response::HTTP_OK);

        $this->assertEquals($response->content(), $this->apiResponce);
        $this->assertEquals($response2->content(), $this->apiResponce3);

        $this->assertDatabaseCount('order_with_scores', 2);

        $this->assertDatabaseHas(
            'order_with_scores',
            ["order_id" => 12345, "client_id" => 54321],
        );
        $this->assertDatabaseHas(
            'order_with_scores',
            ["order_id" => 22222, "client_id" => 54321],
        );
    }
}
