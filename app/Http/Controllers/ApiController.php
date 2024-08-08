<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getProduct()
    {
        $products = Product::where('status', 1)->orderby('id', 'DESC')->paginate(30);
        return response()->json($products);
    }

    function getCategory()
    {
        $categories = Category::where('status', 1)->orderby('id', 'DESC')->paginate(30);

        return response()->json($categories);
    }
}
