<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\Expenseitem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

                Expense::factory(10)->create()->each(function ($expense) {
            $items = Expenseitem::factory(3)->create(['expense_id' => $expense->id]);
            $expense->update([
                'amount' => $items->sum('total'),
            ]);
        });


        // For Users
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
    }
}
