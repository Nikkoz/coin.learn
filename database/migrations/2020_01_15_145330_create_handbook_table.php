<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandbookTable extends Migration
{
    private $handbookTable = 'handbooks';

    public function up(): void
    {
        Schema::create($this->handbookTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50)->nullable(false)->comment('Фраза');
            $table->string('alias', 50)->nullable(false);
            $table->unsignedBigInteger('coin_id')->nullable(false)->comment('Монета');
            $table->boolean('check_case')->default(0)->comment('Регистрозависимость');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('Статус');

            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('CASCADE')->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->handbookTable);
    }
}
