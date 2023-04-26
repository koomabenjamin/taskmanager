<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedbigInteger('project_id'); 
            $table->string('members');
            $table->string('tags');
            $table->string('category');
            $table->enum('status', array('Pending', 'Progress', 'Done'))->default('Pending')->nullable();
            $table->string('priority_level');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
            $table->unsignedbigInteger('added_by');
            $table->foreign('added_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
