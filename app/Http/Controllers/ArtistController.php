<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $artists = Artist::query()
            //query voor niet ingelogde gebruikers
            ->when(!auth()->check(), function ($query) {
                $query->where('hidden', false);
            })
            //query voor ingelogd maar niet dezelfde user
            ->when(auth()->check() && !auth()->user()->admin, function ($query) {
                $query->where(function ($q) {
                    $q->where('hidden', false)
                        ->orWhere('user_id', auth()->id());
                });
            })
            ->get();

        $selectedGenre = null;

        return view('home', compact('artists', 'selectedGenre'));
    }


    //function for showing albums
    public function album()
    {
        $albums = Album::all();
        return view('album', compact('albums'));
    }

    //function for showing artists on home screen
    public function show($id)
    {
        $artist = Artist::findorfail($id);

        if ($artist->hidden) {
            if (!auth()->check() || (!auth()->user()->admin && auth()->id() !== $artist->user_id)) {
                abort(403, 'Artist is hidden');
            }
        }

        return view('artist.show', compact('artist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artist.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!auth()->check()) {
            abort(403, 'You have to be logged in');
        };

        $request->validate([
            'artist_name' => 'required|string|max:30',
            'genre' => 'required|string|in:Rock,Pop,Metal,Jazz,Hip-Hop,Classical,Alternative',
            'description' => 'required|string|max:255',
        ], [
            'artist_name.max' => 'Name is too long',
            'description.max' => 'Description is too long',
        ]);

        Artist::create([
            'artist_name' => $request->artist_name,
            'genre' => $request->genre,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home');
    }

    public function destroy(Artist $artist)
    {
        $user = auth()->user();

        if ($user && ($user->admin || $user->id === $artist->user_id)) {
            $artist->delete();
            return redirect()->back()->with('success', 'Artist deleted successfully.');
        }
        abort(403, 'Unauthorized action.');
    }

    public function toggleHidden(Artist $artist)
    {
        // Only admin or owner can hide/unhide
        if (!auth()->check() || (!auth()->user()->admin && auth()->id() !== $artist->user_id)) {
            abort(403);
        }

        $artist->hidden = !$artist->hidden; // toggle
        $artist->save();

        return redirect()->back();
    }

    public function filter(Request $request)
    {
        $genre = $request->genre;
        $selectedGenre = $genre;

        $artists = Artist::query()
            ->when($genre, function ($query) use ($genre) {
                $query->where('genre', $genre);
            })
            ->when(!auth()->check(), function ($query) {
                $query->where('hidden', false);
            })
            ->when(auth()->check() && !auth()->user()->admin, function ($query) {
                $query->where(function ($q) {
                    $q->where('hidden', false)
                        ->orWhere('user_id', auth()->id());
                });
            })
            ->get();

        if ($request->ajax()) {
            return view('home', compact('artists'))->render();
        }


        return view('home', compact('artists', 'selectedGenre'));
    }

    public function edit(Artist $artist)
    {
        // Only allow admin or owner
        if (!auth()->check() || (!auth()->user()->admin && auth()->id() !== $artist->user_id)) {
            abort(403);
        }
        return view('artist.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'artist_name' => 'required|string|max:30',
            'genre' => 'required|string|in:Rock,Pop,Metal,Jazz,Hip-Hop,Classical,Alternative',
            'description' => 'required|string|max:255',
        ], [
            'artist_name.max' => 'Name is too long',
            'description.max' => 'Description is too long',
        ]);

        if (!auth()->check() || (!auth()->user()->admin && auth()->id() !== $artist->user_id)) {
            abort(403);
        }

        $artist->update([
            'artist_name' => $request->artist_name,
            'genre' => $request->genre,
            'description' => $request->description,

        ]);

        return redirect()->route('home')->with('success', 'Artist updated!');
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        $artists = Artist::query()
            ->when($search, function ($query, $search) {
                $query->where('artist_name', 'like', "%{$search}%");
            })
            ->when(!auth()->check(), function ($query) {
                $query->where('hidden', false);
            })
            ->when(auth()->check() && !auth()->user()->admin, function ($query) {
                $query->where(function ($q) {
                    $q->where('hidden', false)
                        ->orWhere('user_id', auth()->id());
                });
            })
            ->get();


        return view('home', [
            'artists' => $artists,
            'selectedGenre' => null,
            'search' => $search,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
}
