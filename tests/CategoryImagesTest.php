<?php
use App\Stock\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/6/16
 * Time: 10:47 AM
 */
class CategoryImagesTest extends TestCase
{
    use TestsImageUploads, DatabaseMigrations;

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_associated_with_a_category()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $category = factory(Category::class)->create();
        $this->assertCount(0, $category->getMedia());

        $response = $this->call('POST', '/admin/categories/' . $category->id . '/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $category->getMedia());
        $category->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_category_has_a_default_image()
    {
        $category = factory(Category::class)->create();
        $this->assertCount(0, $category->getMedia());

        $this->assertNotNull($category->imageSrc());
    }
}