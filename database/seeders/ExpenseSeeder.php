<?php

namespace Database\Seeders;
use App\Models\Expense;
use App\Models\ExpenseItem;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Expense::factory(10)->create()->each(function ($expense) {
            $items = ExpenseItem::factory(3)->create(['expense_id' => $expense->id]);
            $expense->update([
                'amount' => $items->sum('total'),
            ]);
        });*/
    }
}
