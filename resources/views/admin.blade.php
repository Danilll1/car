@extends('layouts.layout')

@section('content')
    <div class="container my-4">
        <h2 class="mb-4 text-center">Управление заявками</h2>
        @foreach ($requests as $request)
            <div class="card mb-4 shadow-sm">
                <div class="card-body bg-light">
                    <form action="{{ route('admin.edit') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="id_user" value="{{ $request->id_user }}">

                        <div class="d-flex flex-column gap-2 mb-3">
                            <h5 class="card-title text-primary mb-3">Заявка №{{ $request->id }}</h5>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Пользователь:</h6>
                                <p class="mb-0">{{ Auth::user()->full_name }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Автомобиль:</h6>
                                <p class="mb-0">{{ $request->car->name }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Статус:</h6>
                                <p class="mb-0">{{ $request->status->name }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Дата бронирования:</h6>
                                <p class="mb-0">{{ $request->booking_date }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Права:</h6>
                                <p class="mb-0">{{ $request->prava }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Дата выдачи прав:</h6>
                                <p class="mb-0">{{ $request->prava_date }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Адрес:</h6>
                                <p class="mb-0">{{ $request->adress }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Контакт:</h6>
                                <p class="mb-0">{{ $request->contact }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status-{{ $request->id }}" class="form-label"><strong>Статус:</strong></label>
                            <select name="id_status" id="status-{{ $request->id }}" class="form-select" required>
                                <option value="{{ $request->status->id }}" selected>{{ $request->status->name }}</option>
                                @foreach ($statuses as $status)
                                    @if ($status->id != $request->status->id)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_message-{{ $request->id }}" class="form-label"><strong>Сообщение
                                    администратора:</strong></label>
                            <textarea name="admin_message" id="admin_message-{{ $request->id }}" class="form-control" rows="6"
                                placeholder="Введите сообщение для заявки">{{ old('admin_message', $request->admin_message ?? '') }}</textarea>
                        </div>
                        
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <button type="submit" class="btn btn-primary flex-fill">Изменить</button>
                        </div>
                    </form>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <form action="{{ route('admin.destroy', $request->id) }}" method="POST" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-center mt-4">
            <a href="/requests" class="btn btn-outline-primary btn-lg">Перейти к заявкам</a>
        </div>
    </div>
@endsection