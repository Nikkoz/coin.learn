<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCoins extends Migration
{
    protected $coinTable = 'coins';
    protected $encryptionTable = 'algorithm_encryption';
    protected $consensusTable = 'algorithm_consensus';

    public function up(): void
    {
        Schema::create($this->encryptionTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false)->unique()->comment('Название алгоритма');
        });

        Schema::create($this->consensusTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false)->unique()->comment('Название алгоритма');
        });

        Schema::create($this->coinTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable(false)->index()->unique()->comment('Название');
            $table->string('code', 10)->nullable(false)->index()->unique()->comment('Код монеты, например BTC');
            $table->string('slug', 100)->nullable(false);
            $table->integer('image')->nullable(true)->comment('Иконка');
            $table->tinyInteger('type')->default(0)->comment('Тип: Монета или Токен');
            $table->boolean('smart_contracts')->nullable(true)->comment('Наличие смарт-контрактов для монеты');
            $table->string('platform')->nullable(true)->comment('Используемая платформа для токена');
            $table->string('date_start', 50)->nullable(true)->comment('Дата старта');
            $table->integer('encryption')->nullable(true)->comment('Используемый алгоритм шифрования');
            $table->integer('consensus')->nullable(true)->comment('Используемый алгоритм консенсуса');
            $table->boolean('mining')->default(0)->comment('Майниться ли монета');
            $table->bigInteger('max_supply')->nullable(true)->comment('Всего монет');
            $table->text('key_features')->nullable(true)->comment('Ключевые особенности');
            $table->text('use')->nullable(true)->comment('Использование');
            $table->tinyInteger('status')->nullable(false)->default(0)->comment('Статус');
            $table->json('site')->nullable(true)->comment('json массив сайтов монеты');
            $table->json('link')->nullable(true)->comment('json массив дополнительных ссылок');
            $table->json('chat')->nullable(true)->comment('json массив ссылок на чаты');
            $table->timestamps();

            $table->foreign('encryption')->references('id')->on('algorithm_encryption')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('consensus')->references('id')->on('algorithm_consensus')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('image')->references('id')->on('images')->onDelete('SET NULL')->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->coinTable);
    }
}
