<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function createComment(Request $request){

        $fields = $request->validate([
            'comment' => 'required|string',
            'blog_id' => 'required|integer'
        ]);
        $message = '';
        $error = false;

        try {
            $fields += [
                'user_id' => auth()->user()->id
            ];
            Comment::create($fields);
            $blog = Blog::find($fields['blog_id']);

            (new HistoryController)->Add("you commented on blog  <b>" . $blog->heading . "</b> successfully", "Blog comment");

            $message = 'commented successfully';

        } catch (\Throwable $th) {
            $message = $th->getMessage();
            $error = true;
        }

        if ($error) {
            return redirect()->back()->with('error', $message);
        } else {
            return redirect()->back()->with('success', $message);
        }

    }
}
