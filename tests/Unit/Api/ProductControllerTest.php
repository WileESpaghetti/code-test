<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
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

    public function testProductUpdated()
    {
        $product = factory('App\Product')->create();

        $oldDescription = $product->description;
        $updatedDescription = Str::random(144);
        $response = $this->json('PUT', '/api/products/' . $product->id, [
            'description' => $updatedDescription
        ]);
        $response->assertStatus(204);

        $updatedProduct = Product::find($product->id);
        $this->assertNotEquals($oldDescription, $updatedDescription);
        $this->assertEquals($updatedDescription, $updatedProduct->description);
    }

    public function testProductDeleted()
    {
        $product = factory('App\Product')->create();

        $deleteResponse = $this->json('DELETE', '/api/products/' . $product->id);
        $deleteResponse->assertStatus(204);

        $response = $this->json('GET', '/api/products/' . $product->id);
        $response->assertStatus(404);

    }
}
