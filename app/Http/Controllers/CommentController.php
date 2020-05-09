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
    $new_comment= Comment::where('id', $comment->id)->first();
    return response($new_comment, 201);
  }
  public function deleteComment(Request $request)
  {
    \Log::info("deleteComment");
    \Log::info($request->event_id);
    \Log::info($request->comment_id);
    $comment = Comment::where('id', $request->comment_id)->delete();
    $comments = Comment::where('event_id', $request->event_id)->orderBy(Comment::CREATED_AT, 'desc')->paginate();
    return $comments;
  }
  public function editComment(Request $request)
  {
   \Log::info($request->all());
    $comments = $request->all();
    foreach ($comments as $comment)
    {
      Comment::where('id', $comment['id'])->update(['comment' => $comment['comment']]);
    }
  }

}
