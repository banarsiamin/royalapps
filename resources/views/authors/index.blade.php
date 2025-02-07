@extends('layouts.app')

@section('title', 'Authors list')

@section('content')

    <h2>Authors</h2>
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
       
    
    @foreach($authors['items'] as $author)
        @if(is_array($author) && isset($author['id'])) <!-- Check if id exists -->
            <tr>
                <td>{{ $author['id'] }}</td>
                <td>
                    <a href="{{ route('authors.show', ['id' => $author['id']]) }}">
                        {{ $author['first_name'] }} {{ $author['last_name'] }}
                    </a>
                </td>
                <td>
                    <form method="POST" action="{{ route('authors.destroy', $author['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="3" style="color: red;">Invalid author data</td>
            </tr>
        @endif
    @endforeach
</table>
@endsection