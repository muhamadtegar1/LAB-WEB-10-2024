<!-- resources/views/about.blade.php -->
@extends('layouts.master')

@section('title', 'About Us')

@section('content')
    <h1>About Me</h1>
    <p>My name is Muh. Tegar Adyaksa and this year i am gonna turning on 20 years old.</p>
    <p>(I am Cooked ☠️)</p>
    <x-button link="{{ route('contact') }}">Contact Me</x-button>
@endsection
