<?php

namespace App\Managers\Dashboard;

use App\Exceptions\File\FailedFileSaveException;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    /**
     * Сохранение файла из формы.
     *
     * @param UploadedFile $file
     * @param string       $path
     *
     * @throws FailedFileSaveException
     * @return string
     */
    public function save(UploadedFile $file, string $path): string
    {
        $path .= '/' . Carbon::now()->format('Y-m-d');
        $imagePath = $file->store($path);
        if ($imagePath === false) {
            throw new FailedFileSaveException();
        }

        return $imagePath;
    }

    /**
     * Удаление файла по их пути относительно storage.
     *
     * @param array $path
     *
     * @return bool
     */
    public function remove(array $path): bool
    {
        $result = Storage::delete($path);
        if ($result === false) {
            Log::error('Failed delete images', ['images' => $path]);
        }

        return $result;
    }
}