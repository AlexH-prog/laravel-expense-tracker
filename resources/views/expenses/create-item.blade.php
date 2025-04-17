@extends('layouts.expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Добавить статью расхода</h1>

    <form action="{{ route('expense-items.store', $expense->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <label class="block font-semibold mb-2">Статья расхода</label>
        <input type="text" name="category" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Количество</label>
        <input type="number" name="quantity" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Цена</label>
        <input type="number" name="price" class="w-full p-2 border rounded mb-4" required>

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Добавить</button>
    </form>
@endsection
