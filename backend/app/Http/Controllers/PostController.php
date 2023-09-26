<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
      
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $user = User::find($request->userId);
    //     $user->name = $request->user;
    //     $user->save();

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->title;
        $post->content = $request->content;
        $post->user_id = '1';
        $post->save();
        // return response()->json(['status'=>'post saved', 'code'=>200]);
        return response()->json(["data"=>$post,'status'=>'post saved', 'code'=>200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('user')->where('id', $id)->first();
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->userId);
        $user = User::where('id', $request->userId)->first();
        // dd($user);
        $user->name = $request->user;
        $user->save();
        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = $request->title;
        $post->content = $request->content;
        $post->user_id = $user->id;
        $post->save();
        return response()->json($post);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return response()->json(['status'=>'post deleted', 'code'=>200]);
    }
}
