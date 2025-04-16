@extends('layouts.expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Добавить новый расход</h1>

    <form action="{{ route('expenses.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <label class="block font-semibold mb-2">Дата</label>
        <input type="date" name="date" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Комментарий</label>
        <input type="text" name="comment" class="w-full p-2 border rounded mb-4">

        <label class="block font-semibold mb-2">Количество</label>
        <input type="number" id="quantity" name="items[quantity]" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Цена</label>
        <input type="number" id="price" name="items[price]" class="w-full p-2 border rounded mb-4" required>

        <label class="block font-semibold mb-2">Сумма</label>
        <input type="number" id="total" name="items[total]" class="w-full p-2 border rounded mb-4" readonly>

        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Добавить</button>
    </form>

    <script>
        document.addEventListener("input", function() {
            let quantity = document.getElementById("quantity").value;
            let price = document.getElementById("price").value;
            document.getElementById("total").value = quantity * price;
        });
    </script>
@endsection

