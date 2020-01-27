<?php

namespace Tests\Feature\Services\Dashboard;

use App\Entities\Image;
use App\Managers\Dashboard\FileManager;
use App\Services\Dashboard\ImageService;
use Illuminate\Http\UploadedFile;
use Mockery;
use Tests\DashboardTestCase;

class ImageServiceTest extends DashboardTestCase
{
    private $table = 'images';

    /**
     * @var ImageService
     */
    private $service;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $fileManager = Mockery::mock(FileManager::class);
        $fileManager->shouldReceive('save')
            ->andReturn('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'example.jpg');
        $fileManager->shouldReceive('remove')->andReturn(true);

        $this->service = new ImageService($fileManager);
    }

    public function testCreate(): void
    {
        $file = UploadedFile::fake()->image('example.jpg');

        $data = [
            'file'        => $file,
            'path'        => 'public' . DIRECTORY_SEPARATOR . 'images',
            'description' => 'description',
            'sort'        => 100
        ];

        $this->service->create($data);

        $this->assertDatabaseHas($this->table, [
            'name'        => 'example.jpg',
            'description' => 'description',
            'sort'        => 100
        ]);
    }

    public function testDelete(): void
    {
        /** @var Image $image */
        $image = factory(Image::class)->create();

        $this->service->delete($image);

        $this->assertDatabaseMissing($this->table, [
            'id' => $image->id,
        ]);
    }
}