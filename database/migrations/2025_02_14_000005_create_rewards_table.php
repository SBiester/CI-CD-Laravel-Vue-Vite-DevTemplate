<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardsTable extends Migration {
    public function up() {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('distributed_at')->nullable();
            $table->string('recipient');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('rewards');
    }
};
