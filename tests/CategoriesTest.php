<?php
use App\Stock\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/6/16
 * Time: 8:45 AM
 */
class CategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_category_can_be_created()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('POST', '/admin/categories', [
            'name' => 'Books',
            'description' => 'Things you can read'
        ]);

        $this->assertEquals(302, $response->status());
        $this->seeInDatabase('categories', [
            'name' => 'Books',
            'description' => 'Things you can read'
        ]);
    }

    /**
     *@test
     */
    public function a_newly_created_category_has_a_slug()
    {
        $category = factory(Category::class)->create(['name' => 'Slugs and stuff']);

        $this->assertNotNull($category->slug);
        $this->assertEquals('slugs-and-stuff', $category->slug);
    }

    /**
     *@test
     */
    public function a_categories_name_and_description_can_be_edited()
    {
        $this->asLoggedInUser();
        $category = factory(Category::class)->create();

        $this->visit('/admin/categories/' . $category->id . '/edit')
            ->type('Updated name', 'name')
            ->type('A whole new description', 'description')
            ->press('Save Changes')
            ->seeInDatabase('categories', [
                'id' => $category->id,
                'name' => 'Updated name',
                'description' => 'A whole new description'
            ]);
    }

    /**
     *@test
     */
    public function a_category_is_soft_deleted()
    {
        $category = factory(Category::class)->create();
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/categories/' . $category->id);
        $this->assertEquals(302, $response->status());

        $this->assertSoftDeleted($category);
    }

}