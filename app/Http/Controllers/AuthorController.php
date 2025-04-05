<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Author;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if(Auth::user()->role == 'user') {
                // Fetch authors from the database
            $authors = Author::all();
            // Return the authors to the view
            return view('authors.index', compact('authors'))->with('username', Auth::user()->name);
        }
        else {
            // If the user is not an admin, redirect them to the home page or show an error
            return redirect()->route('books.index')->with('error', 'Unauthorized access');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
