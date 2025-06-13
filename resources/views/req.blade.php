@extends('layouts.layout')

@section('header')

@endsection

@section('content')
    <div class="container my-5">
        <!-- Форма создания заявки -->
        <div class="d-flex justify-content-center mb-5">
            <form action="{{ route('request.store') }}" method="POST" class="card border-0 shadow rounded-4 p-4 w-100"
                style="max-width: 600px;">
                @csrf
                <h2 class="text-center mb-4 text-secondary">Создать заявку</h2>

                <div class="mb-3">
                    <label for="car" class="form-label fw-semibold">Выберите автомобиль</label>
                    <select name="id_car" id="car" class="form-select" required>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}">{{ $car->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="booking_date" class="form-label fw-semibold">Дата бронирования</label>
                    <input type="datetime-local" name="booking_date" id="booking_date" class="form-control"
                        min="2000-01-01T00:00" max="2099-12-31T23:59" required>
                </div>

                <div class="mb-3">
                    <label for="prava" class="form-label fw-semibold">Права</label>
                    <input type="text" name="prava" id="prava" class="form-control" pattern="\d{2} \d{2} \d{6}"
                        placeholder="Пример: 22 22 222222" required>
                </div>

                <div class="mb-3">
                    <label for="prava_date" class="form-label fw-semibold">Дата получения прав</label>
                    <input type="date" name="prava_date" id="prava_date" class="form-control" min="2000-01-01"
                        max="2099-12-31" required>
                </div>

                <div class="mb-3">
                    <label for="adress" class="form-label fw-semibold">Адрес</label>
                    <input type="text" name="adress" id="adress" class="form-control" placeholder="ул. Ленина 1" required>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label fw-semibold">Контакт</label>
                    <input type="text" name="contact" id="contact" class="form-control"
                        placeholder="Можете указать телефон или другое Имя" required>
                </div>

                <div class="mb-3">
                    <label for="oplata" class="form-label fw-semibold">Способ оплаты</label>
                    <select name="oplata" id="oplata" class="form-select" required>
                        <option value="" disabled selected>Выберите способ оплаты</option>
                        <option value="Наличные">Наличные</option>
                        <option value="Карта">Карта</option>
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="userAgreement" required>
                    <label class="form-check-label" for="userAgreement">
                        Я согласен с <a href="#" target="_blank">пользовательским соглашением</a>
                    </label>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg rounded-3 shadow-sm">Подтвердить</button>
                </div>
            </form>
        </div>

        <h2 class="mb-4 text-center text-secondary">Ваши заявки</h2>

        <div class="row gy-4 justify-content-center">
            @foreach ($requests as $request)
                <div class="col-md-4 d-flex">
                    <div class="card flex-fill shadow-sm border-0 rounded-4 bg-light hover-shadow transition-transform">
                        <div class="card-body p-4">
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
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Оплата:</h6>
                                <p class="mb-0">{{ $request->oplata }}</p>
                            </div>
                            <div class="mb-2">
                                <h6 class="fw-semibold mb-1">Статус:</h6>
                                @if($request->status->id === 3) <!-- Отменено -->
                                    <p class="mb-0 text-danger fw-bold">{{ $request->status->name }}</p>
                                @elseif($request->status->id === 1) <!-- В процессе -->
                                    <p class="mb-0 text-secondary">{{ $request->status->name }}</p>
                                @elseif($request->status->id === 4) <!-- Подтверждено -->
                                    <p class="mb-0 text-success fw-bold">{{ $request->status->name }}</p>
                                @else
                                    <p class="mb-0">{{ $request->status->name }}</p> <!-- Другие статусы -->
                                @endif
                            </div>
                            @unless(empty($request->admin_message))
                                <div class="mb-2">
                                    <h6 class="fw-semibold mb-1">Сообщение от администратора:</h6>
                                    <p class="mb-0">{{ $request->admin_message }}</p>
                                </div>
                            @endunless
                        </div>
                        <div class="card-footer bg-transparent border-top-0 d-flex justify-content-end px-4 pb-3">
                            <form action="{{ route('request.destroy', $request->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-3 shadow-sm">Удалить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
            transition: all 0.2s ease-in-out;
        }

        .transition-transform {
            transition: all 0.2s ease-in-out;
        }
    </style>
@endsection

<!-- Скрипт для прав -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('prava');

        input.addEventListener('input', () => {

            let digits = input.value.replace(/\D/g, '');

            if (digits.length > 10) {
                digits = digits.slice(0, 10);
            }

            let parts = [];

            if (digits.length >= 2) {
                parts.push(digits.slice(0, 2));
            } else if (digits.length > 0) {
                parts.push(digits.slice(0));
            }

            if (digits.length >= 4) {
                parts.push(digits.slice(2, 4));
            } else if (digits.length > 2) {
                parts.push(digits.slice(2));
            }

            if (digits.length > 4) {
                parts.push(digits.slice(4, 10));
            }

            input.value = parts.join(' ');
        });
    });
</script>

<!-- Скрипт на время -->
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const input = document.getElementById('booking_date');
        const dateValue = input.value;
        const date = new Date(dateValue);
        const year = date.getFullYear();
        if (year.toString().length !== 4) {
            e.preventDefault();
            alert('Год должен быть 4-значным числом.');
        }
    });
</script>

<!-- Скрипт для даты получения прав -->
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const input = document.getElementById('prava_date');
        const dateValue = input.value;
        const date = new Date(dateValue);
        const year = date.getFullYear();
        if (year.toString().length !== 4 || year < 2000 || year > 2099) {
            e.preventDefault();
            alert('Пожалуйста, выберите дату с 2000 по 2099 год.');
        }
    });
</script>

<!-- Чекбокс -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('userAgreement');
        const submitBtn = document.getElementById('submitBtn');

        checkbox.addEventListener('change', function () {
            submitBtn.disabled = !this.checked;
        });
    });
</script>