@extends('layouts.app')

@section('menu-beranda')
    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
@endsection
@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Selamat datang {{ Auth::user()->name }}
    </h2>
    <p class="text-white">user : {{ Auth::user()->name }}</p>
    <p class="text-white">role : {{ Auth::user()->role->name }}</p>
@endsection
