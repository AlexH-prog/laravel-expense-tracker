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
        Schema::create('expenseitems', function (Blueprint $table) {
            $table->id();

            /*$table->foreignId('expense_id');
            $table->index('expense_id', 'expense_idx');
            $table->foreign('user_id', 'task_user_fk')->on('users')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();*/

            $table->foreignId('expense_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            /*$table->foreignId('user_id');
            $table->index('user_id', 'task_user_idx');
            $table->foreign('user_id', 'task_user_fk')->on('users')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();*/

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenseitems');
    }
};
