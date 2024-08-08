<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Combinations;
class ProductController extends Controller
{


    function toproduct()
    {
        $categories = Category::where('status', 1)->get();
        $attributes = Attribute::where('attribute_status', 1)->get();
        return view('admin.product.create', compact('categories', 'attributes'));
    }

    function toproductstore(Request $request)
    {
        dd($request->all(), json_encode($request->attribute_id));
        $this->validate($request, [
            "category" => "required|bail",
            "product_name" => "required|bail",
            "thumbphotos" => "required|bail",
            "photos" => "required|bail",
            "description" => "required|bail",
            "status" => "required|bail",
            "market_price" => "required|bail",
            "purchase_cost" => "required|bail",
            "gst" => "required|bail",
            "sale_price" => "required|bail",

        ]);
        $product = new Product();
        $product->category_id = $request->category;
        $product->product_name = $request->product_name;
        $product->product_slug = Str::slug($request->product_name);
        $product->thumbphotos = $request->thumbphotos;
        $product->photos = $request->photos;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->attribute_id = json_encode($request->attribute_id);
        $product->video_link = $request->video_link;
        $product->stock = $request->stock;
        $product->in_stock = $request->in_stock;

        $product->market_price = $request->market_price;
        $product->purchase_cost = $request->purchase_cost;
        $product->gst = $request->gst;
        $product->net_cost = $request->net_cost;
        $product->sale_price = $request->sale_price;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product Create Successfully');
        }
        return redirect()->back()->with('error', 'Category Does Not Exist');
    }

   

    function toproductlist()
    {
        $products = Product::with('category')->paginate(12);
        return view('admin.product.list', compact('products'));
    }


    function toproductdelete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product Delete Successfully');
        }
        return redirect()->back()->with('error', 'Product Does Not Exist');
    }

    function toproductedit($id)
    {
        $product = Product::find($id);
        if ($product) {
            $categories = Category::where('status', 1)->get();
            return view('admin.product.edit', compact('categories', 'product'));
        }
        return redirect()->back()->with('error', 'Product  Does Not Exist');
    }


    function toproductupdate(Request $request, $id)
    {
        $this->validate($request, [
            "category" => "required|bail",
            "product_name" => "required|bail",
            "thumbphotos" => "required|bail",
            "photos" => "required|bail",
            "description" => "required|bail",
            "status" => "required|bail",
            "market_price" => "required|bail",
            "purchase_cost" => "required|bail",
            "gst" => "required|bail",
            "sale_price" => "required|bail",
        ]);
        $product = Product::find($id);
        $product->category_id = $request->category;
        $product->product_name = $request->product_name;
        $product->product_slug = Str::slug($request->product_name);
        $product->thumbphotos = $request->thumbphotos;
        $product->photos = $request->photos;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->market_price = $request->market_price;
        $product->purchase_cost = $request->purchase_cost;
        $product->gst = $request->gst;
        $product->video_link = $request->video_link;
        $product->stock = $request->stock;
        $product->in_stock = $request->in_stock;
        $product->net_cost = $request->net_cost;
        $product->sale_price = $request->sale_price;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        if ($product->save()) {
            return redirect()->back()->with('success', 'Product Create Successfully');
        }
        return redirect()->back()->with('error', 'Category Does Not Exist');
        // dd($request, $id);
    }

    function toproductsearch(Request $request)
    {
        $paginate = $request->paginate ?? 15;
        if ($request->search) {
            $products = Product::where('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('product_slug', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('tags', 'like', '%' . $request->search . '%')
                ->orWhere('video_link', 'like', '%' . $request->search . '%')
                ->orWhere('meta_title', 'like', '%' . $request->search . '%')
                ->orWhere('meta_keyword', 'like', '%' . $request->search . '%')
                ->orWhere('meta_description', 'like', '%' . $request->search . '%')
                ->paginate($paginate);
        } else {
            $products = Product::with('category')->paginate($paginate);
        }
        return view('admin.product.list', compact('products'));
    }
}
