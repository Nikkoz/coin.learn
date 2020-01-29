<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    private $table = 'sites';

    public function up(): void
    {
        Schema::create($this->table, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->nullable(false)->comment('Название сайта');
            $table->string('link')->unique()->nullable(false)->comment('Ссылка на сайт');
            $table->dateTimeTz('upload')->nullable(true)->comment('Последняя выгрузка');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('Статус');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
