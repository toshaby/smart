@extends('layouts.manager')
@section('title')
Тикет {{ $ticket->id }} от {{ $ticket->customer->name }}
@endsection
@section('content')
<div class="ticket_detail status_{{ $ticket->status }}">
    <div class="detail_item"><a href="{{ route('manager.tickets.index') }}">К списку тикетов</a></div>
    <div class="detail_item"><span class="detail_name">id</span> <span class="detail_value">{{ $ticket->id }}</span></div>
    <div class="detail_item"><span class="detail_name">Тема</span> <span class="detail_value">{{ $ticket->theme }}</span></div>
    <div class="detail_item"><span class="detail_name">Текст</span> <span class="detail_value">{{ $ticket->text }}</span></div>
    <div class="detail_item">
        <span class="detail_name">Статус</span>
        <select id="statusselect" name="status" data-url="{{ route('manager.tickets.update', $ticket->id) }}" data-csrf="{{ csrf_token() }}">
            @foreach ($statuses as $status)
            <option
                {{ ($status->name == $ticket->status) ? 'selected' : '' }}
                value="{{ $status->name }}"
                >{{ $status->getName() }}</option>
            @endforeach
        </select>
    </div>
    <div class="detail_item"><span class="detail_name">Имя</span> <span class="detail_value">{{ $ticket->customer->name }}</span></div>
    <div class="detail_item"><span class="detail_name">Телефон</span> <span class="detail_value">{{ $ticket->customer->phone }}</span></div>
    <div class="detail_item"><span class="detail_name">Email</span> <span class="detail_value">{{ $ticket->customer->email }}</span></div>
    <div class="detail_item"><span class="detail_name">Создан</span> <span class="detail_value">{{ $ticket->created_at }}</span></div>
    <div class="detail_item"><span class="detail_name">Изменен</span> <span class="detail_value">{{ $ticket->updated_at }}</span></div>
    <div class="detail_item"><span class="detail_name">Дата ответа</span> <span class="detail_value">{{ $ticket->answered_at }}</span></div>
    <div class="detail_item"><span class="detail_name">Файлы</span>
        <span class="detail_value">
            @foreach ($ticket->getMedia() as $file)
                <a href="{{ $file->getUrl() }}" title="{{ $file->file_name }}" download>
                    @if (preg_match("/^image/", $file->mime_type))
                        <img src="{{ $file->getUrl() }}" width="100px" alt="">
                    @else
                        {{ $file->file_name }}
                    @endif
                </a>&nbsp;
            @endforeach
        </span>
    </div>
    <div class="detail_item"><a href="{{ route('manager.tickets.index') }}">К списку тикетов</a></div>
</div>
@endsection