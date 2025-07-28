<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration {
    public function up() {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['eingereicht', 'gesichtet', 'abgelehnt', 'beim Experten', 'in der Prämierung', 'abgeschlossen']);
            $table->text('notes')->nullable();
            $table->text('issue')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('tasks');
    }
};
