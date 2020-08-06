<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function testAllProductsRetrieved()
    {
        $products = factory('App\Product', 25)->create();

        $response = $this->json('GET', '/api/products');
        $response
            ->assertStatus(200)
            ->assertJsonCount(25);
    }
}
