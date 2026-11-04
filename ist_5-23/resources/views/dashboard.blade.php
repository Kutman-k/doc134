@extends('layouts.app')
@section('title', 'Личный кабинет')

@section('content')
<h1>Привет, {{ $user->name }}</h1>

@if($user->avatar)
    <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" style="max-width:150px;">
@endif

<ul>
    <li><b>Email:</b> {{ $user->email }}</li>
    <li><b>Телефон:</b> {{ $user->phone }}</li>
    <li><b>Пол:</b> {{ $user->gender }}</li>
    <li><b>Дата рождения:</b> {{ $user->birth_date }}</li>
    <li><b>Город:</b> {{ $user->city }}</li>
    <li><b>О себе:</b> {{ $user->bio ?? '-' }}</li>
    <li><b>Телеграм:</b> {{ $user->telegram ?? '-' }}</li>
    <li><b>Подписан:</b> {{ $user->is_subcribed ? 'да' : 'нет' }}</li>
</ul>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Выйти</button>
</form>
@endsection