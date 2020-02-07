<?php

namespace Tests\Feature\Services\Dashboard;

use Throwable;
use Exception;
use App\Entities\Post;
use Illuminate\Support\Arr;
use Tests\DashboardTestCase;
use App\Entities\Coin\Handbook;
use App\Services\Dashboard\PostService;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Database\Eloquent\Collection;

class PostServiceTest extends DashboardTestCase
{
    private $table = 'posts';

    /**
     * @var PostService
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app()->make(PostService::class);
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $data
     * @param bool  $error
     *
     * @throws Throwable
     */
    public function testCreate(array $data, bool $error): void
    {
        /** @var Collection|Handbook[] $handbooks */
        $handbooks = factory(Handbook::class, 3)->create();

        $data = array_merge($data, [
            'handbooks' => $handbooks->pluck('id')->toArray(),
        ]);

        if ($error) {
            $this->expectException(Throwable::class);
        }

        $post = $this->service->create($data);

        if (!$error) {
            $this->assertDatabaseHas($this->table, [
                'id'   => $post->id,
                'type' => $data['type'],
            ]);
        }
    }

    /**
     * @dataProvider providerUpdate
     *
     * @param array $data
     *
     * @throws Throwable
     */
    public function testUpdate(array $data): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create($data);

        $this->service->update($post->id, Arr::prepend($data, 'new title', 'title'));

        $this->assertDatabaseHas($this->table, ['title' => 'new title']);
        $this->assertDatabaseMissing($this->table, ['title' => $data['title']]);
    }

    /**
     * @dataProvider providerUpdate
     *
     * @param array $data
     *
     * @throws Exception
     */
    public function testDelete(array $data): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create($data);

        $this->service->delete($post->id);

        $this->assertDatabaseMissing($this->table, [
            'title' => $data['title'],
            'type'  => $data['type'],
        ]);
    }

    public function providerCreate(): array
    {
        return [
            [['type' => PostTypeDictionary::TYPE_POST, 'title' => 'new post', 'link' => 'link', 'created' => date('Y-m-d H:i'), 'text' => 'Text for test news post.', 'section' => 'test'], false],
        ];
    }

    public function providerUpdate(): array
    {
        return [
            [['type' => PostTypeDictionary::TYPE_POST, 'title' => 'old title', 'link' => 'link', 'created' => date('Y-m-d H:i'), 'text' => 'Text for test news post.', 'section' => 'test']],
        ];
    }
}