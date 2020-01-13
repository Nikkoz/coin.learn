<?php

namespace App\Services\Dashboard;

use App\Entities\Image;
use App\Exceptions\FailedSaveModelException;
use App\Exceptions\File\FailedFileSaveException;
use App\Managers\Dashboard\FileManager;
use Exception;
use Throwable;

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
     * @throws Throwable
     * @return int
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
            $fillData['sort'] = $data['description'];
        }

        $image->fill($fillData);

        return $image->saveOrFail();
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

        if (!($image->delete() !== true)) {
            $this->manager->remove($path);
        }

        return !($image instanceof Image);
    }
}