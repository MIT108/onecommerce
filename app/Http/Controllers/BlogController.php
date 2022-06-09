<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\comment;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();


        if (isset($_GET['id'])) {
            if (Blog::find($_GET['id'])) {
                $oneBlog = Blog::where('blogs.id', $_GET['id'])->join('users', 'users.id', '=', 'blogs.user_id')->get(['blogs.*', 'users.email as sendEmail'])[0];
                $comments = Comment::where('blog_id', $_GET['id'])->orderBy('id', 'DESC')->get()->map( function ($comment){
                    if($comment->user_id){
                        return [
                            'comment' => $comment,
                            'individual' => User::find($comment->user_id),
                        ];
                    }else{
                        return [
                            'comment' => $comment,
                            'individual' => Subscribe::find($comment->subscribe_id)
                        ];
                    }
                });
                // dd($comments);
                // $comments = Comment::where('blog_id', $_GET['id'])->with('user','subscriber')->first();

                return view('pages/all-post')
                    ->with('blogs', $blogs)
                    ->with('comments', $comments)
                    ->with('oneBlog', $oneBlog);
            } else {
                return redirect()->route('all.post');
            }
        }

        return view('pages/all-post')
            ->with('blogs', $blogs);
    }

    public function postPage(){
        $blogs = Blog::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();


        if (isset($_GET['id'])) {
            if (Blog::find($_GET['id'])) {
                $oneBlog = Blog::where('blogs.id', $_GET['id'])->join('users', 'users.id', '=', 'blogs.user_id')->get(['blogs.*', 'users.email as sendEmail'])[0];
                $comments = Comment::where('blog_id', $_GET['id'])->orderBy('id', 'DESC')->get()->map( function ($comment){
                    if($comment->user_id){
                        return [
                            'comment' => $comment,
                            'individual' => User::find($comment->user_id),
                        ];
                    }else{
                        return [
                            'comment' => $comment,
                            'individual' => Subscribe::find($comment->subscribe_id)
                        ];
                    }
                });
                // dd($comments);
                // $comments = Comment::where('blog_id', $_GET['id'])->with('user','subscriber')->first();

                return view('pages/all-post')
                    ->with('blogs', $blogs)
                    ->with('comments', $comments)
                    ->with('oneBlog', $oneBlog);
            } else {
                return redirect()->route('all.post');
            }
        }

        return view('pages/post-page')
            ->with('blogs', $blogs);


    }
    public function createBlog(Request $request)
    {

        $fields = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
        ]);

        $message = '';
        $error = false;

        if ($request->image) {

            $mytime = Carbon::now();

            $serialNumber = strtotime($mytime);

            $imageFullName = $request->file('image')->getClientOriginalName();

            $fileName = $serialNumber . $imageFullName;

            $fields += [
                'image' => $fileName
            ];
        }
        $fields += [
            'user_id' => auth()->user()->id
        ];

        try {
            Blog::create($fields);

            if ($request->image) {
                $request->file('image')->storeAs('public/images/blog', $fileName);
            }

            (new HistoryController)->Add("Blog with heading <b>" . $fields['heading'] . "</b> created successfully", "Blog creation");

            $message = 'Blog added successfully';
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
