@extends('layouts.expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Редактировать расход</h1>

    <form action="{{ route('general-expenses.update', $expense->id) }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <label class="block font-semibold mb-2">Дата</label>
        <input type="date" name="date" value="{{ old('date', $expense->date) }}" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Комментарий</label>
        <input type="text" name="comment" value="{{ old('comment', $expense->comment) }}" class="w-full p-2 border rounded mb-4">

        {{--@foreach($expense->items as $item)
            <label class="block font-semibold mb-2">Статья: {{ $item->category }}</label>
            <input type="number" name="items[{{ $loop->index }}][quantity]" value="{{ $item->quantity }}" class="w-full p-2 border rounded mb-4" required>

            <label class="block font-semibold mb-2">Цена</label>
            <input type="number" name="items[{{ $loop->index }}][price]" value="{{ $item->price }}" class="w-full p-2 border rounded mb-4" required>
        @endforeach--}}

        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Сохранить</button>
    </form>
@endsection
