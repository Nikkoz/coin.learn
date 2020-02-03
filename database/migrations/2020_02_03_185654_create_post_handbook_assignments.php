<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostHandbookAssignments extends Migration
{
    private $table = 'post_handbook_assignments';

    public function up(): void
    {
        Schema::create($this->table, static function (Blueprint $table) {
            $table->bigInteger('post_id');
            $table->bigInteger('handbook_id');

            $table->primary(['post_id', 'handbook_id']);

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('CASCADE')->onUpdate('RESTRICT');
            $table->foreign('handbook_id')->references('id')->on('handbooks')->onDelete('CASCADE')
                ->onUpdate('RESTRICT');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
}
