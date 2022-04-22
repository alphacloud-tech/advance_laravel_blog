<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        // return $request->all();

        // you need to change database strict mode. for disable follow below step

        // 1. Open config/database.php

        // 2. find 'strict' change the value true to false and try again

        // if (trim($request->category_id) == "") {
        //     $input = $request->except('category_id');
        // }else {
        //     $input = $request->all(); //assign the request from input

        // }

        $input = $request->all(); //assign the request from input

        $user = Auth::user(); // getting login user

        if ($file_path = $request->file("photo_id")) { // chech to see if dere is file
            # code...
            // return "its working";

            $name = time() . $file_path->getClientOriginalName(); // get file name

            $file_path->move("images", $name); // move the name n file to images folder

            $photo = Photo::create(["file"=>$name]); // create a photo

            $input["photo_id"] = $photo->id; // insert photo id to post database
        }

        // grab d user post, use posts() in dis case;  bcos we r using another chain
        // another method i.e create() method
        $user->posts()->create($input);

        return redirect("/admin/posts");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
