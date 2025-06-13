@extends('layouts.layout')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Регистрация</h1>

        {{-- Проверка наличия сообщения об успехе --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="card p-4 shadow-sm">
                <input type="hidden" name="id_role" value="1">

                <div class="mb-3">
                    <input type="text" class="form-control" name="driver_license" placeholder="Логин" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="full_name" placeholder="Полное имя" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="+7(___)-___-__-__-"
                        required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Пароль" required
                        pattern=".{6,}" title="Пароль должен содержать не менее 6 символов">
                    <div class="invalid-feedback">
                        Пароль должен содержать не менее 6 символов.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Подтвердить</button>
            </div>
        </form>
    </div>
@endsection

<!-- Телефон с +7 -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('phone');

        input.addEventListener('input', () => {
            // Удаляем все нецифровые символы
            let digits = input.value.replace(/\D/g, '');

            // Обеспечиваем, что номер начинается с 7
            if (digits.startsWith('8')) {
                digits = '7' + digits.slice(1);
            } else if (!digits.startsWith('7')) {
                if (digits.length > 0) {
                    digits = '7' + digits;
                }
            }

            // Ограничение длины — 11 символов (7 + 10 цифр)
            if (digits.length > 11) {
                digits = digits.slice(0, 11);
            }

            // Формируем формат с пробелами
            let formatted = '+7';

            if (digits.length > 1) {
                formatted += ' ' + digits.slice(1, 4); // XXX
            }

            if (digits.length >= 4) {
                formatted += ' ' + digits.slice(4, 7); // XXX
            }

            if (digits.length >= 7) {
                formatted += ' ' + digits.slice(7, 9); // XX
            }

            if (digits.length >= 9) {
                formatted += ' ' + digits.slice(9, 11); // XX
            }

            input.value = formatted;
        });
    });
</script>

<!-- Шестизначный пороль -->
<script>
    // Проверка перед отправкой формы
    document.querySelector('form').addEventListener('submit', function (event) {
        const passwordInput = document.getElementById('password');
        if (!passwordInput.checkValidity()) {
            event.preventDefault();
            passwordInput.classList.add('is-invalid');
        } else {
            passwordInput.classList.remove('is-invalid');
        }
    });
</script>