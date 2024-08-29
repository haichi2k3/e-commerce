<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Rate;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::orderBy('id', 'desc')->paginate(3);
        return view('frontend.blog.blog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $avgRate = Rate::where('id_blog', $id)->avg('rate');
        $comment = Comments::where('id_blog', $id)->get();

        $pre = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = Blog::where('id', '>', $id)->orderBy('id')->first();


        return view('frontend.blog.blog_single', compact('blog', 'pre', 'next', 'avgRate', 'comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function rate(Request $request)
    {
        $ratingValue = $request->input('ratingValue');
        $user = Auth::user();
        $blog = Blog::find($request->input('id_blog'));

        $exitsRate = Rate::where('id_user', $user->id)
                            ->where('id_blog', $blog->id)
                            ->first();

        if ($exitsRate) {
            $exitsRate->rate = $ratingValue;
            $exitsRate->save();
        } else {
            $rate = new Rate();
            $rate->id_user = $user->id;
            $rate->id_blog = $blog->id;
            $rate->rate = $ratingValue;

            $rate->save();
        }

        $response = [
            'message' => 'Đánh giá thành công',
        ];

        return response()->json($response);
        

    }

    public function comment(Request $request)
    {
        $user = Auth::user();
        $id_blog = $request->input('id_blog');
        $level = $request->input('id_parent');
        $message = $request->input('message');

        $comment = new Comments();
        $comment->id_blog = $id_blog;
        $comment->id_user = $user->id;
        $comment->cmt = $message;
        $comment->avatar = $user->avatar;
        $comment->name = $user->name;

        if (!empty($level)) {
            $comment->level = $level;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Bình luận đã được đăng.');
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
