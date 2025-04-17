@extends('layouts.expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Добавить общие данные списка расхода</h1>

    <form action="{{ route('general-expenses.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <label class="block font-semibold mb-2">Дата</label>
        <input type="date" name="date" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Комментарий</label>
        <input type="text" name="comment" class="w-full p-2 border rounded mb-4">

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Создать</button>
    </form>
@endsection
