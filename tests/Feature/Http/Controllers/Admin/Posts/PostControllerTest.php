<?php

namespace Tests\Feature\Http\Controllers\Admin\Posts;

use App\Entities\Post;
use Tests\DashboardTestCase;
use App\Entities\Coin\Handbook;
use App\Entities\Settings\Site;
use App\Dictionaries\PostTypeDictionary;
use Illuminate\Database\Eloquent\Collection;

class PostControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        $response = $this->get(route('admin.news.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('admin.news.create'));
        $response->assertStatus(200);
    }

    /**
     * @dataProvider providerStore
     *
     * @param array  $params
     * @param string $session
     * @param bool   $isError
     */
    public function testStore(array $params, string $session, bool $isError): void
    {
        /** @var Collection|Handbook[] $handbooks */
        $handbooks = factory(Handbook::class, 3)->create();

        /** @var Site $site */
        $site = factory(Site::class)->create();

        $response = $this->post(route('admin.news.store'), array_merge($params, [
            'handbooks' => $handbooks->pluck('id')->toArray(),
            'site_id'   => $site->id,
        ]));
        $response->assertStatus(302);

        if ($session) {
            $response->assertSessionHas($session);
        }

        if (!$isError) {
            $this->assertDatabaseHas('posts', $params);
        }
    }

    public function testEdit(): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create();

        $response = $this->get(route('admin.news.edit', $post->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Collection|Handbook[] $handbooks */
        $handbooks = factory(Handbook::class, 3)->create();

        /** @var Site $site */
        $site = factory(Site::class)->create();

        /** @var Post $post */
        $post = factory(Post::class)->create([
            'title' => 'oldTitle',
            'type'  => PostTypeDictionary::TYPE_POST,
        ]);

        $data = [
            'title'     => 'newTitle',
            'type'      => $post->type,
            'handbooks' => $handbooks->pluck('id')->toArray(),
            'created'   => date('Y-m-d H:i'),
            'section'   => $post->section,
            'text'      => $post->text,
            'site_id'   => $site->id,
            'link'      => 'newLink',
        ];

        $response = $this->put(route('admin.news.update', $post->id), $data);
        $response->assertStatus(302);

        $post->refresh();

        unset($data['handbooks']);
        $check = array_merge($post->getAttributes(), $data);

        $this->assertDatabaseHas('posts', $check);

        $this->assertDatabaseHas('post_handbook_assignments', [
            'post_id'     => $post->id,
            'handbook_id' => $handbooks->first()->id,
        ]);

        $this->assertDatabaseHas('post_handbook_assignments', [
            'post_id'     => $post->id,
            'handbook_id' => $handbooks->last()->id,
        ]);
    }

    public function testDelete(): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create([
            'type' => PostTypeDictionary::TYPE_POST,
        ]);

        $response = $this->delete(route('admin.news.destroy', $post->id));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);

        foreach ($post->handbooks as $handbook) {
            $this->assertDatabaseMissing('post_handbook_assignments', [
                'post_id'     => $post->id,
                'handbook_id' => $handbook->id,
            ]);
        }
    }

    public function providerStore(): array
    {
        return [
            [['type' => PostTypeDictionary::TYPE_POST, 'title' => 'new post', 'link' => 'link', 'created' => date('Y-m-d H:i'), 'text' => 'Text for test news post.', 'section' => 'test'], '', false], // сохраниться
            [['type' => PostTypeDictionary::TYPE_POST, 'title' => 'new post2', 'link' => '', 'created' => date('Y.m.d H:i'), 'text' => 'Text for test news post.', 'section' => 'test'], 'errors', true], // ошибка валидации
        ];
    }
}