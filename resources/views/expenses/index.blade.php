@extends('layouts.expense')

@section('content')

    <h1 class=" text-2xl font-bold mb-6 text-center">Списки расходов</h1>

    @auth
        {{--<a href="{{ route('general-expenses.create') }}" class=" mt-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Добавить список</a>--}}
        <a href="{{ route('general-expenses.create') }}" class=" mt-4 bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Добавить список</a>
    @endauth


    @foreach($expenses as $expense)
        <!-- Общие данные -->
        <div class="mt-7 mb-1 p-4 bg-gray-100 rounded-lg shadow-md">
            <p><strong>ID: </strong> {{ $expense->id }}   @if(Auth::user()!== null)  @if(Auth::user()->id == $expense->user_id) <strong>User: </strong><span style="color: blue;">{{ Auth::user()->name }}</span>@endif  @endif </p>
            <p><strong>Дата:</strong> {{ $expense->date }}</p>
            <p><strong>Комментарий:</strong> {{ $expense->comment }}</p>
            <p><strong>Общая сумма:</strong> {{ $expense->amount }} грн</p>

              @auth
                @if(Auth::user()->id === $expense->user_id)
                    <a href="{{ route('general-expenses.edit', $expense->id) }}" class="text-blue-500 hover:underline">Редактировать дата / комментарий</a>
                @endif
              @endauth


            {{--@auth
                @if(Auth::user()->id === $expense->user_id)
                <a href="{{ route('expense-items.create', $expense->id) }}" class="text-blue-500 hover:underline">Добавить статью</a>
                @endif
            @endauth--}}
        </div>

        <!-- Таблица статей -->
        <table class="w-full border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-4 py-2">Статья</th>
                <th class="px-4 py-2">Количество</th>
                <th class="px-4 py-2">Цена</th>
                <th class="px-4 py-2">Сумма</th>
                @auth
                    @if(Auth::user()->id === $expense->user_id)
                        <td class="px-4 py-2 bg-white">
                            <a href="{{ route('expense-items.create', $expense->id) }}" class="font-bold text-blue-500 hover:underline">Добавить статью</a>
                        </td>
                    @endif
                @endauth

            </tr>
            </thead>
            <tbody>
            @foreach($expense->items as $item)
                <tr class="border-t border-gray-300">
                    <td class="px-4 py-2">{{ $item->category }}</td>
                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                    <td class="px-4 py-2">{{ $item->price }} грн</td>
                    <td class="px-4 py-2">{{ $item->total }} грн</td>
                    @auth
                        @if(Auth::user()->id === $expense->user_id)
                            <td class="px-4 py-2">
                                <a href="{{ route('expense-items.edit', $item->id) }}" class="text-blue-500 hover:underline">Редактировать</a>
                            </td>
                        @endif
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
@endsection
