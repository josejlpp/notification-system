<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get()
    {
        return response(CategoryModel::all(), 200);
    }
}
