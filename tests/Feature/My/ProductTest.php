<?php

namespace Tests\Feature\My;

use App\Models\Trader4\V1\Category;
use App\Models\Trader4\V1\Market\Platform;
use App\Models\Trader4\V1\Post;
use App\Models\Trader4\V1\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\FeatureTestCase;
use Tests\RemoteUser;

class ProductTest extends FeatureTestCase
{
    use RefreshDatabase, RemoteUser;

    const PRODUCT_RESOURCE_KEYS = [
        'uuid',
        'title',
        'slogan',
        'introduction',
        'description',
        'logo',
        'cover',
        'downloads',
        'views',
        'purchases',
        'likes',
        'type',
        'status',
        'published_at',
        'updated_at',
        'tags',
    ];

    private function createProduct($count = 1, $restData = [])
    {
        $factory = Post::factory();
        if ($count === 1)
            return $factory->createOne($restData);

        return $factory->count($count)->create($restData);
    }

    private function requestWithHeaders()
    {
        return $this->withHeaders(['Authorization' => 'Bearer ' . $this->getToken()]);
    }

    /**
     * @group my-products
     * Tests my products list
     */
    public function test_product_index()
    {
        $this->createProduct(8);
        $response = $this->requestWithHeaders()->get('/api/v1/my/products');

        $response->assertOk()
            ->assertSee(self::PRODUCT_RESOURCE_KEYS);
    }

    /**
     * @group my-products
     * Tests getting single from my products
     */
    public function test_product_single()
    {
        $product = $this->createProduct();
        $response = $this->requestWithHeaders()->get('/api/v1/my/products/' . $product->id);

        $response->assertOk()
            ->assertSee(self::PRODUCT_RESOURCE_KEYS);
    }

    /**
     * @group my-products
     * Tests creating product
     */
    public function test_store_product()
    {
        $categories = implode(',', Category::factory(2)->create()->pluck('id')->flatten()->toArray());
        $tags = implode(',', Tag::factory(2)->create()->pluck('id')->flatten()->toArray());
        $platforms = implode(',', Platform::factory(2)->create()->pluck('id')->flatten()->toArray());

        $payload = [
            'title'        => 'Title',
            'slogan'       => 'Slogan',
            'type'         => 0,
            'introduction' => 'Introduction',
            'description'  => 'Description',
            'categories'   => $categories,
            'tags'         => $tags,
            'platforms'    => $platforms,
        ];
        $response = $this->requestWithHeaders()->post('/api/v1/my/products/', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /**
     * @group my-products
     * Tests updating product
     */
    public function test_update_product()
    {
        $product = $this->createProduct();
        $payload = [
            'title'        => 'New Title',
            'description'  => 'New Description',
        ];
        $response = $this->requestWithHeaders()->put('/api/v1/my/products/' . $product->id, $payload);

        $this->assertEquals($payload['title'], $product->title);
        $this->assertEquals($payload['description'], $product->description);

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $product->id,
                'title' => $payload['title'],
                'description' => $payload['description'],
            ]);
    }

    /**
     * @group my-products
     * Tests deleting product
     */
    public function test_delete_product()
    {
        $product = $this->createProduct();
        $response = $this->requestWithHeaders()->delete('/api/v1/my/products/' . $product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertOk();
    }
}
