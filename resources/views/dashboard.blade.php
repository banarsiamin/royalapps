<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, {{ session('user')['first_name'] }} {{ session('user')['last_name'] }}</h2>
    <a href="{{ route('authors.index') }}">View Authors</a> | 
    <a href="{{ route('books.create') }}">Add Book</a> | 
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html> -->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Welcome to RoyalApp</h2>
    <p>This is your dashboard.</p>
@endsection
