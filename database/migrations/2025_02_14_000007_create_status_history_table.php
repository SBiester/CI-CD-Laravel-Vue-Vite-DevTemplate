<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusHistoryTable extends Migration {
    public function up() {
        Schema::create('status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idea_id')->constrained('tasks')->onDelete('cascade');
            $table->enum('status', ['eingereicht', 'gesichtet', 'abgelehnt', 'beim Experten', 'in der Prämierung', 'abgeschlossen']);
            $table->timestamp('changed_at')->useCurrent();
        });
    }
    public function down() {
        Schema::dropIfExists('status_history');
    }
};
