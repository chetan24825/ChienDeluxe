<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function tocategory()
    {
        $category = Category::paginate(12);
        return view('admin.category.categorylist', compact('category'));
    }

    public function tocategorystore(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories,category_name|max:255',

        ]);
        $check = Category::where('category_name', $request->category)->first();
        if ($check) {
            return redirect()->back()->with('error', 'The category has already been taken. ');
        }

        $category = new Category;
        $category->category_name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->image = $request->image;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->save();
        return redirect()->back()->with('success', ' Category Create Successfully');
    }

    public function toeditcategory(Request $request)
    {
        $this->validate($request, [
            'cname' => 'required',
            'catid' => 'required'
        ]);

        $category = Category::find($request->catid);
        if ($category) {
            $category->category_name  = $request->cname;
            $category->slug = Str::slug($request->cname);
            $category->status = $request->status;
            $category->image = $request->image;
            $category->visible = $request->visible;
            $category->sort = $request->sort;
            $category->meta_title = $request->meta_title;
            $category->meta_keywords = $request->meta_keywords;
            $category->meta_description = $request->meta_description;
            $category->save();
            return redirect()->back()->with('success', 'Category Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Some thing Wrong');
        }
    }

    function tocategorydelete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category Does Not Exist');
        }

        if ($category) {
            $subcategory = SubCategory::where('category_id', $id)->count();
            if ($subcategory > 0) {
                return redirect()->back()->with('error', 'Subcategory exist for this category');
            }
        }

        $productCount = Product::where('category_id', $id)->count();

        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Products exist for this category');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    /**Sub Category**/

    function tosubcategory()
    {
        $category = Category::where('status', 1)->get();
        $subcategory = SubCategory::with('category')->paginate(30);
        return view('admin.category.subcategorylist', compact('category', 'subcategory'));
    }

    public function tosubcategorystore(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'sub_category_name' => 'required|unique:sub_categories,sub_category_name|max:255',

        ]);
        $check = SubCategory::where('sub_category_name', $request->sub_category_name)->first();
        if ($check) {
            return redirect()->back()->with('error', 'The Sub category has already been taken. ');
        }

        $category = new SubCategory;
        $category->category_id = $request->category_id;
        $category->sub_category_name = $request->sub_category_name;
        $category->sub_category_slug = Str::slug($request->sub_category_name);
        $category->sub_category_image = $request->sub_category_image;
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->save();
        return redirect()->back()->with('success', 'Create Successfully');
    }

    public function tosubeditcategory(Request $request)
    {

        $this->validate($request, [
            'sub_category_name' => 'required|unique:sub_categories,sub_category_name,' . $request->subcatid,
            'subcatid' => 'required'
        ]);

        $subcategory = SubCategory::find($request->subcatid);
        if ($subcategory) {
            $subcategory->category_id  = $request->category_id;
            $subcategory->sub_category_name  = $request->sub_category_name;
            $subcategory->sub_category_slug = Str::slug($request->sub_category_name);
            $subcategory->sub_category_status = $request->sub_category_status;
            $subcategory->sub_category_image = $request->sub_category_image;
            $subcategory->meta_title = $request->meta_title;
            $subcategory->banner = $request->banner;
            $subcategory->meta_keywords = $request->meta_keywords;
            $subcategory->meta_description = $request->meta_description;
            $subcategory->save();
            return redirect()->back()->with('success', ' Update Successfully');
        } else {
            return redirect()->back()->with('error', 'Some thing Wrong');
        }
    }

    function tosubcategorydelete($id)
    {
        $category = SubCategory::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Sub Category Does Not Exist');
        }

        $productCount = Product::where('sub_category_id', $id)->count();

        if ($productCount > 0) {
            return redirect()->back()->with('error', 'Products exist for this category');
        }

        $category->delete();

        return redirect()->back()->with('success', 'deleted successfully');
    }


    /**Sub Sub Category**/
    function toajaxsubcat(Request $request)
    {
        $subcat = SubCategory::where('category_id', $request->id)->where('sub_category_status', 1)->get();
        return response()->json($subcat);
    }
}
