<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImages extends Migration
{
    protected $imagesTable = 'images';

    public function up(): void
    {
        Schema::create($this->imagesTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false)->comment('Название изображения');
            $table->string('path')->nullable(false)->comment('Путь к изображению');
            $table->string('description')->nullable(true)->comment('Описание изображения');
            $table->integer('sort')->nullable(false)->default(100)->comment('Сортировка');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->imagesTable);
    }
}
