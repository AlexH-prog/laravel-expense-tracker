<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    // Метод для отображения списка всех расходов
    public function index()
    {
        $expenses = Expense::with('items')->get();
        return view('expenses.index', compact('expenses'));
    }

    // ------------------------- Общие данные ------------------------- //

    // Метод для создания общих данных расхода
    public function createGeneral()
    {
        return view('expenses.create-general');
    }

    public function storeGeneral(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'comment' => 'nullable|string|max:255',
        ]);

        $expense = Auth::user()->expenses()->create([
            'date' => $validated['date'],
            'comment' => $validated['comment'],
            'amount' => 0, // Пустая сумма для начала
        ]);

        return redirect()->route('expenses.index')->with('success', 'Общие данные расхода успешно созданы!');
    }

    // Метод для редактирования общих данных расхода
    public function editGeneral(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit-general', compact('expense'));
    }

    public function updateGeneral(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $validated = $request->validate([
            'date' => 'required|date',
            'comment' => 'nullable|string|max:255',
        ]);

        $expense->update($validated);

        return redirect()->route('expenses.index')->with('success', 'Общие данные расхода успешно обновлены!');
    }

    // ------------------------- Статьи расходов ------------------------- //

    // Метод для создания новой статьи расхода
    public function createItem(Expense $expense)
    {
        return view('expenses.create-item', compact('expense'));
    }

    public function storeItem(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $expense->items()->create($validated);

        // Обновляем общую сумму в общих данных
        $expense->update([
            'amount' => $expense->items->sum('total'),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Статья расхода успешно добавлена!');
    }

    // Метод для редактирования статьи расхода
    public function editItem(ExpenseItem $expenseItem)
    {
        //dd($expenseItem);
        //dd($expenseItem->expense);
        $this->authorize('update', $expenseItem->expense);
        return view('expenses.edit-item', compact('expenseItem'));
    }

    public function updateItem(Request $request, ExpenseItem $expenseItem)
    {
        $this->authorize('update', $expenseItem->expense);

        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $expenseItem->update($validated);

        // Обновляем общую сумму в общих данных
        $expenseItem->expense->update([
            'amount' => $expenseItem->expense->items->sum('total'),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Статья расхода успешно обновлена!');
    }
}
