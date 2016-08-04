<?php
use App\Breadcrumbs\Breadcrumbs;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/2/16
 * Time: 2:06 PM
 */
class BreadcrumbsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function it_builds_the_correct_breadcrumb_trail_for_a_product()
    {
        $expected = [
            ['href' => '/', 'name' => 'home'],
            ['href' => '/categories/bats', 'name' => 'bats'],
            ['href' => '/products/hammer', 'name' => 'hammer']
        ];

        $category = factory(Category::class)->create(['name' => 'bats']);
        $product = factory(Product::class)->create(['category_id' => $category->id, 'name' => 'hammer']);

        $this->assertEquals($expected, Breadcrumbs::makeFor($product));
    }

    /**
     *@test
     */
    public function it_builds_the_correct_breadcrumb_trail_for_a_category()
    {
        $expected = [
            ['href' => '/', 'name' => 'home'],
            ['href' => '/categories/bats', 'name' => 'bats']
        ];

        $category = factory(Category::class)->create(['name' => 'bats']);

        $this->assertEquals($expected, Breadcrumbs::makeFor($category));
    }
}