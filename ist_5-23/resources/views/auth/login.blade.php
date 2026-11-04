@extends('layouts.app')
@section('title', 'Вход')

@section('content')
<h1>Вход</h1>

@if($errors->any())
<div class="alert alert-error">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="{{ route('login') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Пароль</label>
    <input type="password" name="password" required>

    <label>
        <input type="checkbox" name="remember">
        Запомнить меня
    </label>

    <button type="submit">Войти</button>

    <p>
        Нет аккаунта?
        <a href="{{ route('register') }}">Регистрация</a>
    </p>
</form>
@endsection