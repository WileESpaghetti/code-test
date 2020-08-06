<?php

namespace Tests\Feature;

use App\Product;
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

    public function testProductCreated()
    {
        $product = [
            'name' => 'example',
            'description' => 'my description',
            'price' => 12.34,
            'image' => 'test'
        ];

        $response = $this->json('POST', '/api/products', $product);
        $response
            ->assertStatus(201)
            ->assertJsonFragment($product);

    }

    public function testProductRetrieved()
    {
        $product = factory('App\Product')->create();

        $response = $this->json('GET', '/api/products/' . $product->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'description',
                'price',
                'image'
            ]);
    }

    public function testProductNotRetrieved()
    {
        $product = factory('App\Product')->create();
        Product::destroy($product->id);

        $response = $this->json('GET', '/api/products/' . $product->id);

        $response->assertStatus(404);
    }
}
