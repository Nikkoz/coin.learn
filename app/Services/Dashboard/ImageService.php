<?php

namespace App\Services\Dashboard;

use Log;
use Exception;
use Throwable;
use App\Entities\Image;
use App\Managers\Dashboard\FileManager;
use App\Exceptions\FailedSaveModelException;
use App\Exceptions\File\FailedFileSaveException;

class ImageService
{
    /**
     * @var FileManager
     */
    protected $manager;

    public function __construct(FileManager $manager)
    {
        $this->manager = $manager;
    }

    public function create(array $data): Image
    {
        $image = new Image();

        if (!$this->save($image, $data)) {
            throw new FailedSaveModelException(Image::class);
        }

        return $image;
    }

    /**
     * @param Image $image
     * @param array $data
     *
     * @throws FailedFileSaveException
     * @return bool
     */
    protected function save(Image $image, array $data): bool
    {
        $path = $this->manager->save($data['file'], $data['path']);

        $fillData = [
            'name' => $data['file']->getClientOriginalName(),
            'path' => $path,
        ];

        if (isset($data['description'])) {
            $fillData['description'] = $data['description'];
        }

        if (isset($data['sort'])) {
            $fillData['sort'] = $data['sort'];
        }

        try {
            $image->fill($fillData);

            return $image->saveOrFail();
        } catch (Throwable $e) {
            Log::error($e->getMessage(), ['data' => $data]);
        }

        return false;
    }

    /**
     * Удаление.
     *
     * @param Image $image
     *
     * @throws Exception
     * @return bool
     */
    public function delete(Image $image): bool
    {
        $path = $image->path;
        $result = $image->delete();

        if ($result === true) {
            $result = $this->manager->remove($path);
        }

        return $result;
    }
}