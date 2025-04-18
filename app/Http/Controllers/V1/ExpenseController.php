<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Http\Requests\V1\StoreExpenseRequest;
use App\Http\Requests\V1\UpdateExpenseRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('items')->get();
        return view('expenses.v1expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expenses.v1expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validated();
        //dd($validated);
        //dd($validated[$items['quantity']]);

        $expense = Auth::user()->expenses()->create([
            'date' => $validated['date'],
            'comment' => $validated['comment'],
            //'amount' => $validated[[2 =>'items']['quantity']] * $validated[[2][1]],
            'amount' => collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['price']),
        ]);

        foreach ($validated['items'] as $itemData) {
            $expense->items()->create([
                'category' => $itemData['category'],
                'quantity' => $itemData['quantity'],
                'price' => $itemData['price'],
                'total' => $itemData['quantity'] * $itemData['price'],
            ]);
        }

        return redirect()->route('v1expenses.index')->with('success', 'Расход добавлен!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
       // if(Auth::user()) {
            //$this->authorize('update', $expense);
            return view('expenses.v1expenses.edit', compact('expense'));
        /*}
        return view('welcome');*/
    }

    /**
     * Update the specified resource in storage.
     */
   // public function update(Request $request, string $id)

        public function update(UpdateExpenseRequest $request, Expense $expense)
        {
            //$this->authorize('update', $expense);
            $validated = $request->validated();

            $expense->update([
                'date' => $validated['date'],
                'comment' => $validated['comment'],
                'amount' => collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['price']),
            ]);

            //$expense->items()->delete();
            foreach ($validated['items'] as $itemData) {
                $expense->items()->create([
                    'category' => $itemData['category'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'total' => $itemData['quantity'] * $itemData['price'],
                ]);
            }
            return redirect()->route('v1expenses.index')->with('success', 'Расход добавлен!');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
