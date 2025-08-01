<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration {
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->string('author');
            $table->text('comment');
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('comments');
    }
};