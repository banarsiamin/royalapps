<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
///Applications/XAMPP
class BookController extends Controller
{
    public function index()
    {
        if (!Session::has('token')) {
            return redirect()->route('login')->withErrors(['error' => 'Session expired, please log in again.']);
        }
        
        $response = Http::withToken(Session::get('token'))->get('https://candidate-testing.com/api/v2/books?limit=1233&direction=DESC');
        $books = $response->json();
        // echo "<PRE>"; print_r($books);die;
        // Debugging to check the response
        if (!is_array($books)) {
            dd($books); // Dumps the API response and stops execution
        }

        return view('books.index', compact('books'));
    }
    public function create()
    {
        $response = Http::withToken(Session::get('token'))->get('https://candidate-testing.com/api/v2/authors');
        $authors = $response->json();
        //echo "<Pre>"; print_r($authors['items']);die;
        // Debugging to check the response
        if (!is_array($authors)) {
            dd($authors); // This will dump the response and stop execution
        }
    
        return view('books.create', compact('authors'));
    }
    
    public function store(Request $request)
    {
        if (!Session::has('token')) {
            return redirect()->route('login')->withErrors(['error' => 'Session expired, please log in again.']);
        }
        
        $payload = [
            'author' => ['id' => (int)$request->author_id], // Ensure it's an integer
            'title' => $request->title,
            'release_date' => now()->toIso8601String(), // Correct date format
            'description' => $request->title,
            'isbn' => 'Aminkha',//$request->title,
            'format' => 'string',
            'number_of_pages' => 100 // Ensure a valid integer value
        ];
        // $payload = [
        //     'author' => ['id' => (int)$request->author_id], // Nested author
        //     'title' => $request->title,
        //     'release_date' => now()->toIso8601String(), // Correct date format
        //     'description' => $request->description,
        //     'isbn' => $request->isbn,
        //     'format' => 'string',
        //     'number_of_pages' => 100 // Valid integer value
        // ];
        

        $response = Http::withToken(Session::get('token'))
            ->post('https://candidate-testing.com/api/v2/books', $payload);

        if ($response->failed()) {
            dd($response->json()); // Debug the exact error message
        }

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    public function store12(Request $request)
    {
        // echo "<pre>";
        // print_r($_REQUEST);
        // echo $request->title ."<BR>";
        // echo $request->author_id ."<BR>";
        // die;
        $response = Http::withToken(Session::get('token'))->post('https://candidate-testing.com/api/v2/books', [
            'author' => ['id'=>$request->author_id],
            'author_id' => $request->author_id,
            'title' => $request->title,
            'isbn' => $request->title,
            'description' => $request->title,
           // 'isbn' => $request->author_id,
            "format"=> "string",
            'release_date' => date('Y-m-d'),
        ]);
        echo "<PRE>";
        print_r($response);die;
        // {
        //     // "author": {
        //     //   "id": 0
        //     // },
        //     // "title": "string",
        //     // "release_date": "2025-02-07T12:17:33.898Z",
        //     // "description": "string",
        //     // "isbn": "string",
        //     // "format": "string",
        //     // "number_of_pages": 0
        //   }
        // return back()->with('success', 'Book added successfully!');

        // return redirect()->route('books')->with('success', 'Book added successfully!');
    }

    public function destroy($id)
    {
        $response = Http::withToken(Session::get('token'))->delete("https://candidate-testing.com/api/v2/books/{$id}");

        return back()->with('success', 'Book deleted.');
    }
}
