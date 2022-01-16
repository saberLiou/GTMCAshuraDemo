<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePostTranslationBackupToPost()
    {
        $post = Post::create([
            'slug' => 'post1',
            'enabled' => true,
        ]);
        $post->zhtw()->create([
            'locale' => 'zhtw',
            'name' => 'post1_zhtw',
            'description' => 'desc1_zhtw',
        ]);
        $post = $post->fresh();

        // $this->assertEquals('post1_zhtw', \Illuminate\Support\Arr::get($post->name, 'zhtw'));
        $this->assertDatabaseHas($post->getTable(), [
            'name' => json_encode([
                'zhtw' => 'post1_zhtw',
            ]),
            'description' => json_encode([
                'zhtw' => 'desc1_zhtw',
            ]),
        ]);
    }
}
