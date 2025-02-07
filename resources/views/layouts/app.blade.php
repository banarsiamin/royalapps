<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RoyalApp')</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 15px;
            transition: color 0.3s ease-in-out;
        }

        .navbar a:hover {
            color: #dcdcdc;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .logout-btn {
            background-color: #dc3545;
            padding: 8px 15px;
            border-radius: 5px;
            color: white;
            font-size: 14px;
            text-decoration: none;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        /* Main Content Wrapper */
        .container {
            max-width: 1100px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    <style>
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Success Message */
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Delete Button */
        button {
            background-color: #dc3545;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background-color: #c82333;
        }

        /* Back Link */
        .back-link {
            display: inline-block;
            margin: 10px 0;
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .back-link:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div>
            <a href="{{ route('dashboard') }}">RoyalApp</a>
        </div>

        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('authors.index') }}">Authors</a></li>
            <li><a href="{{ route('books.index') }}">Books</a></li>
            <li><a href="{{ route('books.create') }}">Add Book</a></li>
        </ul>

        <div class="user-info">
            @if(Session::has('user'))
                <span>Welcome, {{ Session::get('user')['first_name'] }} {{ Session::get('user')['last_name'] }}</span>
                <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
            @else
                <a href="{{ route('login') }}" class="logout-btn" style="background-color: #28a745;">Login</a>
            @endif
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
