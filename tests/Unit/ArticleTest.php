<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleTest extends TestCase
{
    public function testStore()
    {
        Storage::fake('public');

        $articleData = Article::factory()->make()->toArray();

        $response = $this->post('/articles', array_merge($articleData, [
            'image' => UploadedFile::fake()->image('test.jpg')
        ]));

        $response->assertRedirect('/articles');
        $this->assertDatabaseHas('articles', [
            'title' => $articleData['title'],
            'content' => $articleData['content'],
            'category_id' => $articleData['category_id'],
            'user_id' => $articleData['user_id'],
            'image' => 'test.jpg'
        ]);
        self::assertFileExists(storage_path('public/test.jpg'));
    }
}
