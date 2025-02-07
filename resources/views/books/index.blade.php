@extends('layouts.app')

@section('title', 'List Books')

@section('content')
    <h2>Books</h2>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
       
    
    @foreach($books['items'] as $book)
        @if(is_array($book) && isset($book['id'])) <!-- Check if id exists -->
            <tr>
                <td>{{ $book['id'] }}</td>
                <td>
                    <a href="#">
                        {{ $book['title'] }} 
                    </a>
                </td>
                <td>
                    <form method="POST" action="{{ route('books.destroy', $book['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="3" style="color: red;">Invalid book data</td>
            </tr>
        @endif
    @endforeach
</table>
@endsection

