<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCreatorsTable extends Migration {
    public function up() {
        Schema::create('task_creators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->string('creator');
            $table->string('email');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('task_creators');
    }
};
