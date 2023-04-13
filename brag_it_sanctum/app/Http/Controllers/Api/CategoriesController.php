<?php

namespace App\Http\Controllers\Api;

use App\Models\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();

        foreach ($categories as $category) {

            $posts_count = DB::table('posts')->where('category_id', $category->id)->count();
            $category->posts_count = $posts_count;
            // Count the number of comments for the post
            $comments_count = DB::table('comments')->where('category_id', $category->id)->count();
            $category->comments_count = $comments_count;
        }
        // On retourne les informations des utilisateurs en JSON
        return response()->json($categories);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validated
            $validateCat = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'banner' => 'nullable',
                    'is_archived' => 'nullable',

                ]
            );

            $banner = $request->filled('banner') ? $request->input('banner') : 'default_banner.jpg';
            $isArchived = $request->filled('is_archived') ? $request->input('is_archived') : false;

            if ($validateCat->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCat->errors()
                ], 401);
            }

            Categories::create([
                'name' => $request->name,
                'is_archived' => $isArchived,
                'banner' => $banner,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cat Created Successfully',
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
    public function show(Categories $category)
    {
        return response()->json($category);
    }

    /**
  
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        try {


            //Validated
            $validateCat = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'is_archived' => 'required',
                    'banner' => 'required',

                ]
            );

            if ($validateCat->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateCat->errors()
                ], 401);
            }


            Categories::where('id', $category->id)->update([

                'name' => $request->name,
                'is_archived' => $request->is_archived,
                'banner' => $request->banner,



            ]);

            return response()->json([
                'status' => true,
                'message' => 'Cat updated Successfully',
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
    public function destroy(Categories $category)
    {
        Categories::where('id', $category->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted Successfully',
        ], 200);
    }
}