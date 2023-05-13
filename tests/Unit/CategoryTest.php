<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    public function it_can_create_a_category()
    {
        $category = Category::factory()->create([
            'name' => 'New Category',
            'user_id' => 1
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'New Category',
            'user_id' => 1
        ]);
    }

    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create([
            'name' => 'New Category',
            'user_id' => 1
        ]);

        $category->update([
            'name' => 'Updated Category',
            'user_id' => 1
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Updated Category',
            'user_id' => 1
        ]);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $category->delete();

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
