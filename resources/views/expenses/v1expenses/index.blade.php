@extends('layouts.v1expense')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-center">Список расходов</h1>

    @foreach($expenses as $expense)
        <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow-md">
            <p><strong>ID:</strong> {{ $expense->id }}</p>
            <p><strong>Дата:</strong> {{ $expense->date }}</p>
            <p><strong>Комментарий:</strong> {{ $expense->comment }}</p>
            <p><strong>Общая сумма:</strong> {{ $expense->amount }} $</p>
        </div>

        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-4 py-2">Статья</th>
                <th class="px-4 py-2">Количество</th>
                <th class="px-4 py-2">Цена</th>
                <th class="px-4 py-2">Сумма</th>
                @auth
                    @if(Auth::user()->id === $expense->user_id)
                        <th class="px-4 py-2">Действия</th>
                    @endif
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach($expense->items as $item)
                <tr class="border-t border-gray-300">
                    <td class="px-4 py-2">{{ $item->category }}</td>
                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                    <td class="px-4 py-2">{{ $item->price }} $</td>
                    <td class="px-4 py-2">{{ $item->total }} $</td>
                    @auth
                        @if(Auth::user()->id === $expense->user_id)
                            <td class="px-4 py-2">
                                <a href="{{ route('v1expenses.edit', $expense->id) }}" class="text-blue-500 hover:underline">Редактировать</a>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach

    @auth
        <a href="{{ route('v1expenses.create') }}" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Добавить расход</a>
    @endauth
@endsection
