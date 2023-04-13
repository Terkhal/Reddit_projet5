<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function alldatacount()
    {

        $usersCount = DB::table('users')->count();
        $adminUsersCount = DB::table('users')->where('is_admin', 1)->count();
        $categoriesCount = DB::table('categories')->count();
        $postsCount = DB::table('posts')->count();
        $commentsCount = DB::table('comments')->count();

        $counts = [
            'users' => $usersCount,
            'admin_users' => $adminUsersCount,
            'categories' => $categoriesCount,
            'posts' => $postsCount,
            'comments' => $commentsCount,
        ];

        return response()->json($counts);
    }
}