@extends('layouts.layout')

@section('title', 'Авторизация')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4 text-center">Авторизация</h1>
            <form action="{{ route('auth') }}" method="POST" class="card p-4 shadow-sm">
                @csrf
                <div class="mb-3">
                    <label for="Логин" class="form-label">Логин</label>
                    <!-- <input type="email" class="form-control" id="email" name="email" placeholder="email" required> -->
                    <input type="text" class="form-control" name="driver_license" placeholder="Логин"
                            required>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="пороль"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Войти</button>
            </form>
        </div>
    </div>
@endsection

@if ($errors->has('login'))
    <div class="alert alert-danger">
        {{ $errors->first('login') }}
    </div>
@endif