<?php

namespace App\Services\Dashboard;

use Log;
use Throwable;
use Exception;
use App\Entities\Post;
use App\Exceptions\FailedSaveModelException;
use App\Repositories\Dashboard\PostRepository;

class PostService
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Удаление по id.
     *
     * @param int $id
     *
     * @throws Exception
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->repository->getOne($id);

        return $model->delete() === true;
    }

    /**
     * Создание поста.
     *
     * @param array $data - post данные
     *
     * @throws Throwable
     * @throws FailedSaveModelException
     * @return Post
     */
    public function create(array $data): Post
    {
        $post = new Post;

        if (!$this->save($post, $data)) {
            throw new FailedSaveModelException(Post::class);
        }

        return $post;
    }

    /**
     * Обновление поста.
     *
     * @param int   $id
     * @param array $data
     *
     * @throws Throwable
     * @return Post
     */
    public function update(int $id, array $data): Post
    {
        /** @var Post $post */
        $post = $this->repository->getOne($id);

        if (!$this->save($post, $data)) {
            throw new FailedSaveModelException(Post::class);
        }

        return $post;
    }

    /**
     * Сохранение.
     *
     * @param Post  $post
     * @param array $data
     *
     * @return bool
     */
    protected function save(Post $post, array $data): bool
    {
        try {
            $post->fill($data);

            $post->saveOrFail();

            $post->handbooks()->sync($data['handbooks'] ?? []);

            return true;
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }
}