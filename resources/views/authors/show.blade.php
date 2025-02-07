@extends('layouts.app')

@section('title', 'Author Details')

@section('content')
    <h2>Author: {{ $author['first_name'] }} {{ $author['last_name'] }}</h2>
    <h4>DOB: {{ $author['birthday'] }} ,Gender : {{ $author['gender'] }}</h2>
    <a href="{{ route('authors.index') }}">Back to Authors</a>

    <h3>Books:</h3>
    <pre>
    <?php //print_r($author);die;?>
</pre>
    @if(count($author['books']) > 0)
        <ul>
            @foreach($author['books'] as $book)
                <li>
                    {{ $book['title'] }}
                    <form method="POST" action="{{ route('books.destroy', $book['id']) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No books found.</p>
    @endif

@endsection
    