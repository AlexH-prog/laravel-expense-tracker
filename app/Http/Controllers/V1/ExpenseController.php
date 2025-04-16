<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
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
        return view('expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //dd('dfgdfgfd');
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
       // dd('dfgdfgfd');

        /*$date = $request->input('date'); // Получить 'date'
        $comment = $request->input('comment'); // Получить 'comment'
        $items = $request->input('items'); // Получить массив 'items'*/

        // Используем значения
       /* $quantity = $items['quantity']; // 1
        $price = $items['price']; // 3
        $total = $items['total']; // 3*/

      //echo  dd(1234567);
               $data= $request->validated();
        //dd($data);


        //$expense = Auth::user()->expenses()->create([
        //$us = Auth::user();
        //dd($us->getAuthIdentifier());
        //dd($expense);
        if(Auth::user()) {
            /*$expense = new Expense();
            $expense->create([*/
                Expense::create([
               // 'user_id' => Auth::user()->getAuthIdentifier(),
                'user_id' => Auth::user()->id,
                'date' => $data['date'],
                'comment' => $data['comment'],
                'amount' => $data['items']['quantity'] * $data['items']['price'],
                // 'amount' => collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['price']),
            ]);
           // dd(storage_path());

            /*expenses()->create([
                'date' => $validated['date'],
                'comment' => $validated['comment'],
                'amount' => collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['price']),
            ]);

            foreach ($validated['items'] as $itemData) {
                $expense->items()->create([
                    'category' => $itemData['category'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'total' => $itemData['quantity'] * $itemData['price'],
                ]);
            }*/
        }
        return redirect()->route('expenses.index')->with('success', 'Расход добавлен!');
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
        $this->authorize('update', $expense);
        return view('expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, string $id)

        public function update(UpdateExpenseRequest $request, Expense $expense)
        {
            $this->authorize('update', $expense);

            $validated = $request->validated();

            $expense->update([
                'date' => $validated['date'],
                'comment' => $validated['comment'],
                'amount' => collect($validated['items'])->sum(fn($item) => $item['quantity'] * $item['price']),
            ]);

            $expense->items()->delete();
            foreach ($validated['items'] as $itemData) {
                $expense->items()->create([
                    'category' => $itemData['category'],
                    'quantity' => $itemData['quantity'],
                    'price' => $itemData['price'],
                    'total' => $itemData['quantity'] * $itemData['price'],
                ]);
            }

            return redirect()->route('expenses.index')->with('success', 'Расход обновлен!');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
