<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\Comments;

use Illuminate\Support\Facades\Validator;

class DataController extends Controller
{
    public function topCat()
    {


        return Comments::groupBy('category_id')
            ->selectRaw('count(*) as total, category_id')
            ->with("category")
            ->get();
        // On retourne les informations des utilisateurs en JSON
    }
}
