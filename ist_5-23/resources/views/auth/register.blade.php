@extends('layouts.app')
@section('title', 'Регистрация')

@section('content')
<h1>Регистрация</h1>

@if($errors->any())
<div class="alert alert-error">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Имя</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required>

    <label>Телефон</label>
    <input type="text" name="phone" value="{{ old('phone') }}" required>

    <label>Пол</label>
    <select name="gender" required>
        <option value="">-- Укажите пол --</option>
        <option value="male" @selected(old('gender')=='male')>Мужской</option>
        <option value="female" @selected(old('gender')=='female')>Женский</option>
        <option value="other" @selected(old('gender')=='other')>Не определился</option>
    </select>

    <label>Дата рождения</label>
    <input type="date" name="birth_date" value="{{ old('birth_date') }}" required>

    <label>Город</label>
    <input type="text" name="city" value="{{ old('city') }}">

    <label>О себе</label>
    <textarea name="bio" rows="3">{{ old('bio') }}</textarea>

    <label>Аватарка</label>
    <input type="file" name="avatar" accept="image/*">

    <label>Телеграм</label>
    <input type="text" name="telegram" value="{{ old('telegram') }}" placeholder="@username">

    <label>
        <input type="checkbox" name="is_subcribed" value="1" @checked(old('is_subcribed'))>
        Подписаться на рассылку
    </label>

    <label>Пароль</label>
    <input type="password" name="password" required>

    <label>Повторите пароль</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit" class="btn">Регистрация</button>

    <p>
        Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
    </p>
</form>
@endsection