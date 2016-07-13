<?php
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/12/16
 * Time: 10:55 AM
 */
class ProductsSearchControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_index_of_all_products_is_returned()
    {
        $product = factory(Product::class)->create([
            'name'        => 'Ultrathon 3000',
            'price'       => 1000,
            'description' => 'A brief description'
        ]);
        $product2 = factory(Product::class)->create([
            'name'        => 'SledgeHammer XL',
            'price'       => 2000,
            'description' => 'A briefer description'
        ]);

        $this->asLoggedInUser();

        $response = $this->call('GET', '/admin/products');
        $this->assertEquals(200, $response->status());

        $expected = [
            [
                'id'          => $product->id,
                'name'        => 'Ultrathon 3000',
                'description' => 'A brief description',
                'thumb_src'   => '/images/assets/default.jpg'
            ],
            [
                'id'          => $product2->id,
                'name'        => 'SledgeHammer XL',
                'description' => 'A briefer description',
                'thumb_src'   => '/images/assets/default.jpg'
            ]
        ];

        $this->assertEquals($expected, json_decode($response->getContent(), true));
    }
}