<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStock;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }


        $choice_options = array();
        
            if($request->has('choice_no')){
                foreach ($request->choice_no as $key => $no) {
                    $str = 'choice_options_'.$no;

                    $item['attribute_id'] = $no;

                    $data = array();
                    foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                        array_push($data, $eachValue->value);
                    }

                    $item['values'] = $data;
                    array_push($choice_options, $item);
                }
            }

            if (!empty($request->choice_no)) {
                $product->attributes = json_encode($request->choice_no);
            }
            else {
                $product->attributes = json_encode(array());
            }

            $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);
            
        if ($product->save()) {
            //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }

        //Generates the combinations of customer choice options
        $combinations = combinations($options);
            if(count($combinations[0]) > 0){
                $product->variant_product = 1;
                foreach ($combinations as $key => $combination){
                    $str = '';
                    foreach ($combination as $key => $item){
                        if($key > 0 ){
                            $str .= '-'.str_replace(' ', '', $item);
                        }
                        else{
                            if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                                $color_name = \App\Models\Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                            }
                            else{
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                    if($product_stock == null){
                        $product_stock = new ProductStock;
                        $product_stock->product_id = $product->id;
                    }

                    $product_stock->variant = $str;
                    $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                    $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                    $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                    $product_stock->image = $request['img_'.str_replace('.', '_', $str)];
                    $product_stock->save();
                }
            }
            else{
                $product_stock = new ProductStock;
                $product_stock->product_id = $product->id;
                $product_stock->price = $request->unit_price;
                $product_stock->qty = $request->current_stock;
                $product_stock->save();
            }
       

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
        // dd($request->all());
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

        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $product->colors = json_encode($request->colors);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }

        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;

                $data = array();
                foreach (json_decode($request[$str][0]) as $key => $eachValue) {
                    array_push($data, $eachValue->value);
                }

                $item['values'] = $data;
                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }

        $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }
        
        if ($product->save()) {
            $combinations = combinations($options);
            if(count($combinations[0]) > 0){
                $product->variant_product = 1;
                foreach ($combinations as $key => $combination){
                    $str = '';
                    foreach ($combination as $key => $item){
                        if($key > 0 ){
                            $str .= '-'.str_replace(' ', '', $item);
                        }
                        else{
                            if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                                $color_name = \App\Models\Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                            }
                            else{
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }

                    $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                    if($product_stock == null){
                        $product_stock = new ProductStock;
                        $product_stock->product_id = $product->id;
                    }

                    $product_stock->variant = $str;
                    $product_stock->price =  $request['price_'.str_replace('.', '_', $str)];
                    $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                    $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
                    $product_stock->image = $request['img_'.str_replace('.', '_', $str)];

                    $product_stock->save();
                }
            }
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
    public function sku_combination(Request $request)
    {
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }
        
        $combinations = combinations($options);
        return view('admin.product.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }

    public function sku_combination_edit(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }
        else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $data = array();
                foreach (json_decode($request[$name][0]) as $key => $item) {
                    array_push($data, $item->value);
                }
                array_push($options, $data);
            }
        }

        $combinations = combinations($options);
        return view('admin.product.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }
}
