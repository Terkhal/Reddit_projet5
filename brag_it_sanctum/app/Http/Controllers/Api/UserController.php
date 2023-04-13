<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\AnteriorToDate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {

            $posts = DB::table('posts')->where('user_id', $user->id)->get();

            // Add the posts to the user object
            $user->posts = $posts;


            $posts_count = DB::table('posts')->where('user_id', $user->id)->count();
            $user->posts_count = $posts_count;
            // Count the number of comments for the post
            $comments_count = DB::table('comments')->where('user_id', $user->id)->count();
            $user->comments_count = $comments_count;
        }



        // On retourne les informations des utilisateurs en JSON
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => ['required', 'min:8', 'regex:/[0-9]+/'],
                    'is_admin' => 'required',
                    'date_of_birth' => ['required', new AnteriorToDate],
                    'avatar_path' => 'sometimes',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'username' => $request->username,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin,
                'date_of_birth' =>  $request->date_of_birth,
                'avatar_path' =>  $request->avatar_path
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
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
    public function show(User $user)
    {
        // On retourne les informations de l'utilisateur en JSON
        return response()->json($user);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {


            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'username' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users')->ignore($user->id),
                    ],
                    'password' => ['sometimes', 'min:8', 'regex:/[0-9]+/'],
                    'is_admin' => 'required',
                    'date_of_birth' => ['required', new AnteriorToDate],
                    'avatar_path' => 'nullable',

                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!empty($request->avatar_path)) {
                $avatar_path = $request->avatar_path;
            } else {
                $avatar_path = $user->avatar_path;
            }

            if (!empty($request->password)) {
                $password = Hash::make($request->password);
            } else {
                $password = $user->password;
            }

            User::where('id', $user->id)->update([

                'username' => $request->username,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => $password,
                'is_admin' => $request->is_admin,
                'date_of_birth' =>  $request->date_of_birth,
                'avatar_path' =>  $avatar_path


            ]);

            return response()->json([
                'status' => true,
                'message' => 'User updated Successfully',
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
    public function destroy(User $user)
    {

        User::where('id', $user->id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted Successfully',
        ], 200);
    }
}
