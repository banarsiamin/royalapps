<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller
{
    
    public function index()
    {
        $response = Http::withToken(Session::get('token'))->get('https://candidate-testing.com/api/v2/authors');
        $authors = $response->json();
        // echo "<PRE>"; print_r($authors);die;
        // Debugging to check the response
        if (!is_array($authors)) {
            dd($authors); // Dumps the API response and stops execution
        }

        return view('authors.index', compact('authors'));
    }


    public function show($id)
    {
        $response = Http::withToken(Session::get('token'))->get("https://candidate-testing.com/api/v2/authors/{$id}");
        $author = $response->json();
    //    echo"<PRE>"; print_r($author);die;
        return view('authors.show', compact('author'));
    }

    public function destroy($id)
    {
        $response = Http::withToken(Session::get('token'))->delete("https://candidate-testing.com/api/v2/authors/{$id}");
        
        if ($response->successful()) {
            return redirect()->route('authors.index')->with('success', 'Author deleted.');
        }
        return back()->with('error', 'Cannot delete author.');
    }
}
