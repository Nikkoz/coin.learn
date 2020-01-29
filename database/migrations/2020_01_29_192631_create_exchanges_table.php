<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangesTable extends Migration
{
    private $table = 'exchanges';

    public function up(): void
    {
        Schema::create($this->table, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->unique()->nullable(false)->comment('Название биржи');
            $table->string('link')->unique()->nullable(false)->comment('Ссылка на соц. сеть');
            $table->unsignedBigInteger('network_id')->nullable(false)->comment('Тип соц. сети');
            $table->text('description')->nullable(true)->comment('Описание');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('Статус');

            $table->foreign('network_id')->references('id')->on('social_networks')->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
