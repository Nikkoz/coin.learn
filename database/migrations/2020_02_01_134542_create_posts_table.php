<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    private $table = 'posts';

    public function up(): void
    {
        Schema::create($this->table, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('type')->nullable(false)->comment('Тип поста');
            $table->string('post_id', 100)->nullable(true)->comment('Идентификатор поста соц. сети');
            $table->bigInteger('coin_id')->nullable(false)->default(0)->comment('Монета');
            $table->string('title', 100)->nullable(false)->comment('Заголовок');
            $table->text('text')->nullable(true)->comment('Текст поста');
            $table->string('link', 255)->nullable(true)->comment('Ссылка на пост');
            $table->dateTimeTz('created')->nullable(false)->comment('Дата создания поста');
            $table->string('section')->nullable(true)->comment('Раздел поста');
            $table->bigInteger('site_id')->nullable(true)->comment('Сайт поста');
            $table->string('user_id', 20)->nullable(true)->comment('Идентификатор пользователя на ресурсе');
            $table->string('user_name', 100)->nullable(true)->comment('Имя пользователя');
            $table->integer('shares')->nullable(false)->default(0)->comment('Кол-во репостов');
            $table->integer('likes')->nullable(false)->default(0)->comment('Кол-во лайков');
            $table->integer('comments')->nullable(false)->default(0)->comment('Кол-во коментариев');
            $table->tinyInteger('status')->nullable(false)->default(1)->comment('Статус');

            $table->timestampsTz();
            /*$table->foreign('coin_id')->references('id')->on('coins')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('CASCADE')->onUpdate('RESTRICT');*/
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
