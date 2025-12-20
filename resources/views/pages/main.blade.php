@extends('index')
@section('title','Главная')
@section('content')

    <a href="{{route('login')}}">Авторизация</a>
    <a href="{{route('register')}}">Регистрация</a>
@endsection
