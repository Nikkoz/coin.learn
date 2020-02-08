<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulasTable extends Migration
{
    private $table = 'formula';

    public function up(): void
    {
        Schema::create($this->table, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('news_max_val')->nullable(false)->default(0)->comment('Макс. значение параметра');
            $table->integer('news_max_count')->nullable(false)->default(0)
                ->comment('Макс. кол-во упоминаний для сайта');
            $table->integer('community_max_val')->nullable(false)->default(0)->comment('Макс. значение параметра');
            $table->integer('community_max_count')->nullable(false)->default(0)->comment('Макс. кол-во единиц');
            $table->integer('developers_max_val')->nullable(false)->default(0)->comment('Макс. значение параметра');
            $table->integer('developers_max_count')->nullable(false)->default(0)
                ->comment('Макс. кол-во активностей в группе');
            $table->integer('exchanges_max_val')->nullable(false)->default(0)->comment('Макс. значение параметра');
            $table->integer('exchanges_max_count')->nullable(false)->default(0)
                ->comment('Макс. кол-во упоминаний в бирже');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
