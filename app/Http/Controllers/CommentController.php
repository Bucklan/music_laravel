<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::with('user')->get();
        return view('adm.moderator.comments.index',['comments'=>$comments]);
    }
    public function store(Request $request){
        $this->authorize('create',Comment::class);
        $validate = $request->validate([
            'text' => 'required',
            'music_id'=>'required|numeric|exists:music,id'
        ]);
        Auth::user()->comments()->create($validate);
        return redirect()->back()->with('message','comment successfully sent');
    }
    public function destroy(Comment $comment){
        $this->authorize('delete',$comment);
        $comment->delete();
        return redirect()->back()->with('message','Your comment successfully deleted');
    }
//
}
