<?php

namespace Tests\Feature\Services\Dashboard;

use Mockery;
use App\Entities\Image;
use Tests\DashboardTestCase;
use Illuminate\Http\UploadedFile;
use App\Managers\Dashboard\FileManager;
use App\Services\Dashboard\ImageService;

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
    }

    public function setUp(): void
    {
        parent::setUp();

        $fileManager = Mockery::mock(FileManager::class);
        $fileManager->shouldReceive('save')
            ->andReturn('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'example.jpg');
        $fileManager->shouldReceive('remove')->andReturn(true);

        $this->service = app()->make(ImageService::class, [$fileManager]);
    }

    public function testCreate(): void
    {
        $file = UploadedFile::fake()->image('example.jpg');

        $data = [
            'file'        => $file,
            'path'        => 'public' . DIRECTORY_SEPARATOR . 'images',
            'description' => 'description',
            'sort'        => 100,
        ];

        $this->service->create($data);

        $this->assertDatabaseHas($this->table, [
            'name'        => 'example.jpg',
            'description' => 'description',
            'sort'        => 100,
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