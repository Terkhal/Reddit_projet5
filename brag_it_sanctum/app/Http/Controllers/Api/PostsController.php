<?php

namespace App\Http\Controllers\Api;

use App\Models\Posts;
use App\Models\Comments;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();


        foreach ($posts as $post) {
            // Retrieve information about the category associated with the comment
            $category_id = $post->category_id;
            if ($category_id !== null) {
                $category = DB::table('categories')->where('id', $category_id)->first();
                $post->category = $category;
            }

            // Retrieve information about the user who made the comment
            $user_id = $post->user_id;
            if ($user_id !== null) {
                $user = DB::table('users')->where('id', $user_id)->first();
                $post->user = $user;
            }


            // Count the number of comments for the post
            $comments_count = DB::table('comments')->where('post_id', $post->id)->count();
            $post->comments_count = $comments_count;
        }





        //return all data as json
        return response()->json($posts);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validated
            $validatePost = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'content' => 'required',
                    'user_id' => 'required',
                    'category_id' => 'required',
                    'image_path' => 'nullable',
                    'is_archived' => 'nullable',

                ]
            );

            $isArchived = $request->filled('is_archived') ? $request->input('is_archived') : false;

            if ($validatePost->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePost->errors()
                ], 401);
            }

            Posts::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'image_path' => $request->image_path,
                'is_archived' => $isArchived,


            ]);

            return response()->json([
                'status' => true,
                'message' => 'Post Created Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Posts $post)
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $post)
    {
        try {


            //Validated
            $validatePost = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'content' => 'required',
                    'user_id' => 'required',
                    'category_id' => 'required',
                    'image_path' => 'nullable',
                    'is_archived' => 'nullable',
                ]
            );

            if ($validatePost->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePost->errors()
                ], 401);
            }


            Posts::where('id', $post->id)->update([

                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'image_path' => $request->image_path,
                'is_archived' => $request->is_archived,



            ]);

            return response()->json([
                'status' => true,
                'message' => 'Post updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        Posts::where('id', $post->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted Successfully',
        ], 200);
    }

    public function getPostfromCat(Categories $category)
    {
        $categories = Posts::all()->where("category_id", $category->id);
        return response()->json($categories);
    }
}