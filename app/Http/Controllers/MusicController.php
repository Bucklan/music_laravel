<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{

    public function subscribe(Request $request, Music $music)
    {
        $musicSubscribe = Auth::user()->musicsSubscribed()->where('music_id', $music->id)->first();
//       dd(Auth::user()->my_balance);
        $balance = 0;
        if ($request->input('months') == 3) {
            $balance = 3000;
        } elseif ($request->input('months') == 6) {
            $balance = 5000;
        }
        if ($request->input('months') == 1
            ||
            $request->input('months') == 3 && Auth::user()->my_balance >= 3000
            ||
            $request->input('months') == 6 && Auth::user()->my_balance >= 5000) {
            if ($musicSubscribe == null) {
                Auth::user()->musicsSubscribed()
                    ->attach($music->id, [
                        'months' => $request->input('months'),
                        'created_at' => Carbon::now()->addHours(6),
                        'updated_at' => Carbon::now()->addHours(6)
                    ]);
                Auth::user()->update(['my_balance' => Auth::user()->my_balance - $balance]);
            } else {
                Auth::user()->musicsSubscribed()
                    ->updateExistingPivot($music->id, [
                        'months' => $request->input('months'),
                        'created_at' => Carbon::now()->addHours(6),
                        'updated_at' => Carbon::now()->addHours(6)
                    ]);
                Auth::user()->update(['my_balance' => Auth::user()->my_balance - $balance]);
            }
            return back()->with('message', 'your subscribe successfully finished');
        }
        return back()->withErrors('net balance');

    }

    public
    function musicsByCategory(Category $category)
    {
        return view('musics.index', ['allMusic' => $category->musics, 'categories' => Category::all()]);
    }

    public
    function selected()
    {
        $selecteds = Auth::user()->musicsLike()->get();
        return view('musics.selected',['selecteds'=>$selecteds]);
    }

    public
    function index(Music $allMusic)
    {

        return view('musics.index', ['allMusic' => $allMusic::with('comments.user')->get(), 'categories' => Category::all()]);
    }


    public
    function create()
    {
        $this->authorize('create', Music::class);
        return view('musics.create', ['categories' => Category::all()]);
    }

    public
    function store(Request $request, Music $musics)
    {

        $balance = 3000;
        $validate = $request->validate([
            'name_music' => 'required|max:255',
            'singer' => 'required|max:100',
            'date' => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'mp3' => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'text' => 'required'
        ]);
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $image_path = $request->file('image')->storeAs('musics', $fileName, 'public');
        $validate['image'] = '/storage/' . $image_path;

        $audiofileName = time() . $request->file('mp3')->getClientOriginalName();
        $mp3_path = $request->file('mp3')->storeAs('audios', $audiofileName, 'public');
        $validate['mp3'] = '/storage/' . $mp3_path;

        $balance += 3000;
        Auth::user()->update(['my_balance' => $balance]);
        Auth::user()->musics()->create($validate);
        return redirect()->route('musics.index')->with('message', 'musics saved');
    }

    public
    function show(Music $music)
    {
        $myRating = 0;
        $musicLikee = false;
        if (Auth::check()) {
            $musicRated = Auth::user()->musicsRated()->where('music_id', $music->id)->first();
            $musicLike = Auth::user()->musicsLike()->where('music_id', $music->id)->first();
            if ($musicRated) {
                $myRating = $musicRated->pivot->rating;
            }
            if ($musicLike) {
                $musicLikee = $musicLike->pivot->like;
            }
        }
        $avgRating = 0;
        $sum = 0;
        $sumLike = 0;

        $ratedUsers = $music->usersRated()->get();
        $LikeUsers = $music->usersLike()->get();
        foreach ($ratedUsers as $ru) {
            $sum += $ru->pivot->rating;
        }
        foreach ($LikeUsers as $like) {
            if ($like->pivot->like) {
                $sumLike += 1;
            }
        }

        if (count($ratedUsers) > 0) {
            $avgRating = $sum / count($ratedUsers);
        }
        if ($avgRating % 1 != 0) {
            $avgRating = $avgRating - $avgRating % 1;;
        }
        return view('musics.show', ['music' => $music, 'categories' => Category::all(),
            'myRating' => $myRating,
            'avg' => $avgRating,
            'like' => $musicLikee,
            'count' => $sumLike]);
    }

    public
    function edit(Music $music)
    {
        return view('musics.edit', ['music' => $music, 'categories' => Category::all()]);
    }

    public
    function update(Request $request, Music $music)
    {
        $this->authorize('delete', $music);
//        dd($request);
        $validate = $request->validate([
            'name_music' => 'required|max:255',
            'singer' => 'required|max:100',
            'date' => 'required',
            'category_id' => 'required|numeric|exists:categories,id',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg',
            'mp3' => 'required|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'text' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $image_path = $request->file('image')->storeAs('musics', $fileName, 'public');
            $validate['image'] = '/storage/' . $image_path;
        }
        if ($request->hasFile('mp3')) {
            $audiofileName = time() . $request->file('mp3')->getClientOriginalName();
            $mp3_path = $request->file('mp3')->storeAs('audios', $audiofileName, 'public');
            $validate['mp3'] = '/storage/' . $mp3_path;
        }
        $music->update($validate);
        return redirect()->route('musics.index')->with('message', 'musics successfully changed');
    }

    public
    function destroy(Music $music)
    {
        $this->authorize('delete', $music);
        $music->delete();
        return redirect()->route('musics.index')->with('message', 'musics successfully deleted');
    }

    public
    function rate(Request $request, Music $music)
    {
        $validate = $request->validate([
            'rating' => 'required|min:1|max:5'
        ]);
        $musicRated = Auth::user()->musicsRated()->where('music_id', $music->id)->first();

        if ($musicRated) {
            Auth::user()->musicsRated()->updateExistingPivot($music->id, $validate);
        } else {
            Auth::user()->musicsRated()->attach($music->id, $validate);

        }
        return back();
    }

    public
    function unrate(Music $music)
    {

        $musicRated = Auth::user()->musicsRated()->where('music_id', $music->id)->first();

        if ($musicRated) {
            Auth::user()->musicsRated()->detach($music->id);
        }
        return back();
    }

    public
    function like(Request $request, Music $music)
    {
        $validate = $request->validate([
            'like' => 'required'
        ]);
        $musicLike = Auth::user()->musicsLike()->where('music_id', $music->id)->first();
        if ($musicLike) {
            Auth::user()->musicsLike()->updateExistingPivot($music->id, $validate);
        } else {
            Auth::user()->musicsLike()->attach($music->id, $validate);

        }
        return back();
    }

}
