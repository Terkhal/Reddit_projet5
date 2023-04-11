<?php

namespace App\Http\Controllers\Api;

use App\Models\Comments;
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

        // On retourne les informations des utilisateurs en JSON
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
}
