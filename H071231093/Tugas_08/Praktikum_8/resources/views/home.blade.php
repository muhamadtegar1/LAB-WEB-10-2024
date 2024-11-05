<!-- resources/views/home.blade.php -->
@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1>Welcome, Tegar 👋🏼</h1>
    <p>This is my first time using Laravel for build a website.</p>
    <x-button link="{{ route('about') }}">About Me</x-button>
@endsection
