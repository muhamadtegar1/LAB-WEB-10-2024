<!-- resources/views/contact.blade.php -->
@extends('layouts.master')

@section('title', 'Contact Us')

@section('content')
    <h1>Contact Me</h1>
    <a href="https://www.instagram.com/_tegaradyaksa/?next=%2F" style="text-decoration: none; color: white; margin-bottom:5px;">Instagram 📸</a>
    <a href="https://wa.me/6281234567890" style="text-decoration: none; color: white; margin-bottom: 15px;">Whats App 📲</a>
    <x-button link="{{ route('home') }}">Home</x-button>
@endsection
