<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoins extends Migration
{
    protected $coinTable       = 'coins';

    protected $encryptionTable = 'algorithm_encryption';

    protected $consensusTable  = 'algorithm_consensus';

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
            $table->bigInteger('market_id')->unique()->nullable(false)->comment('Идентификатор монеты на маркете');
            $table->string('name', 100)->nullable(false)->index()->unique()->comment('Название');
            $table->string('code', 10)->nullable(false)->index()->unique()->comment('Код монеты, например BTC');
            $table->string('alias', 100)->nullable(false);
            $table->unsignedBigInteger('image_id')->nullable(true)->comment('Иконка');
            $table->tinyInteger('type')->default(0)->comment('Тип: Монета или Токен');
            $table->boolean('smart_contracts')->nullable(true)->comment('Наличие смарт-контрактов для монеты');
            $table->string('platform', 255)->nullable(true)->comment('Используемая платформа для токена');
            $table->date('date_start')->nullable(true)->comment('Дата старта');
            $table->unsignedBigInteger('encryption_id')->nullable(true)->comment('Используемый алгоритм шифрования');
            $table->unsignedBigInteger('consensus_id')->nullable(true)->comment('Используемый алгоритм консенсуса');
            $table->boolean('mining')->default(0)->comment('Майниться ли монета');
            $table->bigInteger('max_supply')->nullable(true)->comment('Всего монет');
            $table->text('key_features')->nullable(true)->comment('Ключевые особенности');
            $table->text('use')->nullable(true)->comment('Использование');
            $table->tinyInteger('status')->nullable(false)->default(1)->comment('Статус');
            $table->string('site', 50)->nullable(true)->comment('Официальный сайт монеты');
            $table->string('chat', 50)->nullable(true)->comment('Ссылка на чат');
            $table->json('links')->nullable(true)->comment('Дополнительные ссылки');
            $table->boolean('uploaded')->default(0)->comment('Монета загружена из маркета');

            $table->timestampsTz();

            $table->foreign('encryption_id')->references('id')->on('algorithm_encryption')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('consensus_id')->references('id')->on('algorithm_consensus')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('SET NULL')->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->coinTable);
    }
}
