<?php

namespace Tests\Feature\Http\Controllers\Admin\Posts;

use App\Entities\Post;
use App\Entities\Coin\Coin;
use Illuminate\Support\Arr;
use Tests\DashboardTestCase;
use App\Dictionaries\PostTypeDictionary;

class TwitterControllerTest extends DashboardTestCase
{
    public function testIndex(): void
    {
        $response = $this->get(route('admin.twitter.index'));
        $response->assertStatus(200);
    }

    public function testCreate(): void
    {
        $response = $this->get(route('admin.twitter.create'));
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
        /** @var Coin $coin */
        $coin = factory(Coin::class)->create();

        $response = $this->post(route('admin.twitter.store'), Arr::prepend($params, $coin->id, 'coin_id'));
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
        $post = factory(Post::class)->create(['type' => PostTypeDictionary::TYPE_TWITTER]);

        $response = $this->get(route('admin.twitter.edit', $post->id));
        $response->assertStatus(200);
    }

    public function testUpdate(): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create([
            'type' => PostTypeDictionary::TYPE_TWITTER,
        ]);

        $data = [
            'type'      => $post->type,
            'created'   => date('Y-m-d H:i'),
            'text'      => $post->text,
            'user_id'   => '1234',
            'post_id'   => '1',
            'user_name' => 'Fedya',
        ];

        $response = $this->put(route('admin.twitter.update', $post->id), $data);
        $response->assertStatus(302);

        $post->refresh();

        $check = array_merge($post->getAttributes(), $data);

        $this->assertDatabaseHas('posts', $check);
    }

    public function testDelete(): void
    {
        /** @var Post $post */
        $post = factory(Post::class)->create([
            'type' => PostTypeDictionary::TYPE_TWITTER,
        ]);

        $response = $this->delete(route('admin.twitter.destroy', $post->id));
        $response->assertStatus(302);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }

    public function providerStore(): array
    {
        return [
            [['type' => PostTypeDictionary::TYPE_TWITTER, 'created' => date('Y-m-d H:i'), 'text' => 'Text for test twitter post.', 'post_id' => '1', 'user_id' => '2', 'user_name' => 'login'], '', false], // сохраниться
            [['type' => PostTypeDictionary::TYPE_TWITTER, 'created' => date('Y-m-d H:i'), 'text' => 'Text for test twitter post.'], 'errors', true], // ошибка валидации
        ];
    }
}