
@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
<h2>Add New Book</h2>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Author:</label>
        
         <?php // echo "<Pre>"; print_r($authors);die;?>
        @if(!empty($authors['items']) && is_array($authors['items']))
            <select name="author_id" required>
                @foreach($authors['items'] as $author)
                    @if(is_array($author) && isset($author['id']))
                        <option value="{{ $author['id'] }}">{{ $author['first_name'] }} {{ $author['last_name'] }}</option>
                    @endif
                @endforeach
            </select>
        @else
            <p style="color: red;">No authors found or API error.</p>
        @endif

        <br>
        <button type="submit">Add Book</button>
    </form>
@endsection

    