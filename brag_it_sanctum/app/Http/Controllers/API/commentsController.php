<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\DB;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Posts;
use App\Http\Controllers\Controller;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comments::all();

        foreach ($comments as $comment) {
            // Retrieve information about the category associated with the comment
            $category_id = $comment->category_id;
            if ($category_id !== null) {
                $category = DB::table('categories')->where('id', $category_id)->first();
                $comment->category = $category;
            }

            // Retrieve information about the user who made the comment
            $user_id = $comment->user_id;
            if ($user_id !== null) {
                $user = DB::table('users')->where('id', $user_id)->first();
                $comment->user = $user;
            }

            // Retrieve information about the user who made the comment
            $post_id = $comment->post_id;
            if ($post_id !== null) {
                $post = DB::table('posts')->where('id', $post_id)->first();
                $comment->post = $post;
            }
        }

        // Return the comments information in JSON
        return response()->json($comments);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validated
            $validateCom = Validator::make(
                $request->all(),
                [
                    'content' => 'required',
                    'is_archived' => 'required',
                    'user_id' => 'required',
                    'is_sub_com' => 'required',
                    'reply_to' => 'required',
                    'post_id'  => 'required',
                    'category_id'  => 'required',




                ]
            );

            if ($validateCom->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCom->errors()
                ], 401);
            }

            Comments::create([
                'content' => $request->content,
                'is_archived' => $request->is_archived,
                'user_id' => $request->user_id,
                'is_sub_com' => $request->is_sub_com,
                'reply_to' => $request->reply_to,
                'post_id' => $request->post_id,
                'category_id' => $request->category_id,


            ]);

            return response()->json([
                'status' => true,
                'message' => 'Comment Created Successfully',
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
    public function show(Comments $comment)
    {
        return response()->json($comment);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comment)
    {
        try { //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'content' => 'required',
                    'is_archived' => 'required',
                    'user_id' => 'required',
                    'is_sub_com' => 'required',
                    'reply_to' => 'required',
                    'post_id'  => 'required',
                    'category_id'  => 'required',

                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }


            Comments::where('id', $comment->id)->update([

                'content' => $request->content,
                'is_archived' => $request->is_archived,
                'user_id' => $request->user_id,
                'is_sub_com' => $request->is_sub_com,
                'reply_to' => $request->reply_to,
                'post_id' => $request->post_id,
                'category_id' => $request->category_id,



            ]);

            return response()->json([
                'status' => true,
                'message' => 'Comment updated Successfully',
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
    public function destroy(Comments $comment)
    {
        Comments::where('id', $comment->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Comment deleted Successfully',
        ], 200);
    }

    public function getComfromPost(Posts $post)
    {
        $comments = Comments::all()->where("post_id", $post->id);

        return response()->json($comments);
    }

    public function getComfromCat($category)
    {

        $comments = Comments::all()->where("category_id", $category);


        return response()->json($comments);
    }
}
