@extends('layouts.manager')
@section('title')
Тикеты
@endsection
@section('content')
<div>
    <div class="filter">
        <form class="inline">
            Дата
            <label>
                от 
                <span class="relative">
                    @if ($errors->has('datefrom'))
                    <div class="error_message">{{ implode('<br>', $errors->get('datefrom')) }}</div>
                    @endif
                    <input type="datetime-local" name="datefrom" value="{{ isset($filters['datefrom']) ?  $filters['datefrom'] : old('datefrom') }}">
                </span>
                
            </label>
            <label>
                до 
                <span class="relative">
                    @if ($errors->has('dateto'))
                    <div class="error_message">{{ implode('<br>', $errors->get('dateto')) }}</div>
                    @endif
                    <input type="datetime-local" name="dateto" value="{{ isset($filters['dateto']) ?  $filters['dateto'] : old('dateto') }}">
                </span>
                
            </label>
            <label>
                статус
                <select name="status">
                    <option value="">Нет</option>
                    @foreach ($statuses as $status)
                    <option
                        {{ ((isset($filters['status']) ?  $filters['status'] : old('status')) == $status->name) ? 'selected' : '' }}
                        value="{{ $status->name }}">{{ $status->getName() }}</option>
                    @endforeach
                </select>
            </label>
            <label>
                email
                <span class="relative">
                    @if ($errors->has('email'))
                    <div class="error_message">{{ implode('<br>', $errors->get('email')) }}</div>
                    @endif
                    <input type="email" name="email" value="{{ isset($filters['email']) ?  $filters['email'] : old('email') }}">
                </span>
            </label>
            <label>
                телефон
                <span class="relative">
                    @if ($errors->has('phone'))
                    <div class="error_message">{{ implode('<br>', $errors->get('phone')) }}</div>
                    @endif
                    <input type="text" name="phone" value="{{ isset($filters['phone']) ?  $filters['phone'] : old('phone') }}">
                </span>
            </label>
            <input type="submit" name="filter" value="фильтровать">
        </form>
        <form class="inline">
            <input type="submit" value="сбросить">
        </form>
    </div>
    <table class="main_list">
        <tr>
            <th>id</th>
            <th>Тема</th>
            <th>Текст</th>
            <th>Статус</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Создан</th>
            <th>Изменен</th>
            <th>Дата ответа</th>
        </tr>
        @foreach ($tickets as $ticket)
        <tr class="status_{{ $ticket->status }}">
            <td><a href="{{ route('manager.tickets.show', $ticket->id) }}">{{ $ticket->id }}</a></td>
            <td>{{ $ticket->theme }}</td>
            <td>{{ $ticket->text }}</td>
            <td>{{ $ticket->statusName() }}</td>
            <td>{{ $ticket->customer->name }}</td>
            <td>{{ $ticket->customer->phone }}</td>
            <td>{{ $ticket->customer->email }}</td>
            <td class="nowrap">{{ $ticket->created_at }}</td>
            <td class="nowrap">{{ $ticket->updated_at }}</td>
            <td class="nowrap">{{ $ticket->answered_at }}</td>
        </tr>
        @endforeach
    </table>

    {{ $tickets->onEachSide(5)->links('paginator') }}
</div>
@endsection