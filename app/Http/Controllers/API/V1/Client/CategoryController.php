<?php

namespace App\Http\Controllers\API\V1\Client;

use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'categories' => Category::all()
        ]);
    }
}
