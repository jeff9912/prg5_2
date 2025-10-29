<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = @auth()->user();

        $artistCount = Artist::where('user_id', $user->id)->count();

        if ($artistCount < 3) {
            return redirect()->route('home')->with('error', 'You need to upload 3 artists before you can upload an album');
        } else {
            return view('album.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:30',
            'artist_name' => 'required|string|max:255',
            'picture' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'duration' => 'required|integer',
        ], [
            'title.max' => 'title is too long'
        ]);

        Album::create([
            'title' => $request->title,
            'artist_name' => $request->artist_name,
            'picture' => $request->picture,
            'genre' => $request->genre,
            'duration' => $request->duration,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home');
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
