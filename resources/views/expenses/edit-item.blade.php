@extends('layouts.expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Редактировать расход</h1>

    <form action="{{ route('expense-items.update', $expenseItem->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <label class="block font-semibold mb-2">Статья:</label>
        <input type="text" name="category" value="{{ old('category', $expenseItem->category) }}" class="w-full p-2 border rounded mb-4" >

        <label class="block font-semibold mb-2">Количество</label>
        <input type="text" name="quantity" value="{{ old('quantity', $expenseItem->quantity) }}" class="w-full p-2 border rounded mb-4">

        <label class="block font-semibold mb-2">Цена</label>
        <input type="text" name="price" value="{{ old('price', $expenseItem->price) }}" class="w-full p-2 border rounded mb-4">


        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Сохранить</button>
    </form>
@endsection
