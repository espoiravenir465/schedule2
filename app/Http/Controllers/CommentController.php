<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  public function index(Request $request)
  {
    \Log::info("indexComment");
    \Log::info($request->event_id);
    $comments = Comment::where('event_id', $request->event_id)->orderBy(Comment::CREATED_AT, 'desc')->paginate();
    return $comments;
  }
  public function createComment(Request $request)
  {
    \Log::info("createComment");
    \Log::info($request->get('event_id'));
    \Log::info($request);
    $comment = new Comment();
    $comment->event_id=$request->get('event_id');
    $comment->comment=$request->get('comment');
    $comment->save();
    $new_comment= Comment::where('comment_id', $comment->comment_id)->first();
    return response($new_comment, 201);
  }
}
