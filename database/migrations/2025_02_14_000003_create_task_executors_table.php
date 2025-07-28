<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskExecutorsTable extends Migration {
    public function up() {
        Schema::create('task_executors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->string('executor');
            $table->string('role');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('task_executors');
    }
};