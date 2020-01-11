<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLinksTable extends Migration
{
    private $socialNetworkTable = 'social_networks';

    private $socialLinksTable = 'social_links';

    public function up(): void
    {
        Schema::create($this->socialNetworkTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable(false)->unique()->comment('Название социальной сети');
            $table->string('link', 100)->nullable(false)->unique()->comment('Ссылка на социальную сеть');
            $table->boolean('status')->default(true);
        });

        Schema::create($this->socialLinksTable, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link', 150)->nullable(false)->unique()->comment('Ссылка на социальную сеть');
            $table->integer('network_id')->nullable(false)->comment('Тип социальной сети');
            $table->unsignedBigInteger('coin_id')->nullable(false)->comment('Монета');
            $table->text('description')->nullable(true)->comment('Описание ссылки');

            $table->foreign('network_id')->references('id')->on('social_networks')->onDelete('CASCADE')->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->socialNetworkTable);
        Schema::dropIfExists($this->socialLinksTable);
    }
}
