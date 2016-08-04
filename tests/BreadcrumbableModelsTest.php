<?php
use App\Breadcrumbs\Breadcrumbable;
use App\Stock\Category;
use App\Stock\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/2/16
 * Time: 1:38 PM
 */
class BreadcrumbableModelsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_breadcrumbable_model_can_give_its_own_href()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Breadcrumbable::class, $product);

        $this->assertEquals('/products/'.$product->slug, $product->getModelUrl());
    }

    /**
     *@test
     */
    public function a_breadcrumbable_model_knows_its_parent()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category->id]);

        $parent = $product->getModelParent();

        $this->assertInstanceOf(Category::class, $parent);
        $this->assertEquals($category->id, $parent->id);
        $this->assertEquals('/categories/'.$category->slug, $category->getModelUrl());
    }

    /**
     * @test
     */
    public function a_breadcrumbable_model_has_a_name()
    {
        $product = factory(Product::class)->create();

        $this->assertEquals($product->name, $product->getBreadcrumbName());
    }
}