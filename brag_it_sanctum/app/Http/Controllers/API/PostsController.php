<?php

namespace App\Http\Controllers\Api;

use App\Models\Posts;
use App\Models\Comments;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();


        // On retourne les informations des utilisateurs en JSON
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
                    'image_path' => 'required',
                    'is_archived' => 'required',

                ]
            );

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
                'is_archived' => $request->is_archived,


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
                    'title' => $request->title,
                    'content' => $request->content,
                    'user_id' => $request->user_id,
                    'category_id' => $request->category_id,
                    'image_path' => $request->image_path,
                    'is_archived' => $request->is_archived,

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
