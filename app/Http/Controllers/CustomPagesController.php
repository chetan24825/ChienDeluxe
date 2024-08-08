<?php

namespace App\Http\Controllers;

use App\Models\CustomPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;

class CustomPagesController extends Controller
{

    function topages()
    {
        $pages = CustomPage::orderby('id', 'DESC')->paginate(12);
        return view('admin.pages.custompages.custompage', compact('pages'));
    }

    function topagescreate()
    {
        return view('admin.pages.custompages.create');
    }

    function topagesstore(Request $request)
    {

        try {
            $this->validate($request, [
                "page_name" => "required",
                "description" => "required",
            ]);
            $pages = new CustomPage();
            $pages->page_name = $request->page_name;
            $pages->slug = Str::slug($request->page_name);
            $pages->image = $request->image;
            $pages->short_description = $request->short_description;
            $pages->status = $request->status;
            $pages->link = $request->link;
            $pages->description = $request->description;
            $pages->meta_title = $request->meta_title;
            $pages->meta_keywords = $request->meta_keyword;
            $pages->meta_description = $request->meta_description;
            $pages->viewby = $request->viewby;
            $pages->sort = $request->sort;

            if ($pages->save()) {
                return redirect()->back()->with('success', 'Page Create Successfully');
            }
            return redirect()->back()->with('error', 'some thing wrong');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    function topagesview($id)
    {

        try {
            $pages = CustomPage::find($id);
            return view('admin.pages.custompages.edit', compact('pages'));
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    function topagesedit(Request $request, $id)
    {
        try {
            $this->validate($request, [
                "page_name" => "required",
                "description" => "required",
            ]);
            $pages = CustomPage::find($id);
            $pages->page_name = $request->page_name;
            $pages->slug = Str::slug($request->page_name);
            $pages->image = $request->image;
            $pages->short_description = $request->short_description;
            $pages->status = $request->status;
            $pages->link = $request->link;
            $pages->description = $request->description;
            $pages->meta_title = $request->meta_title;
            $pages->meta_keywords = $request->meta_keyword;
            $pages->meta_description = $request->meta_description;
            $pages->viewby = $request->viewby;
            $pages->sort = $request->sort ;

            if ($pages->save()) {
                return redirect()->back()->with('success', 'Page Update Successfully');
            }
            return redirect()->back()->with('error', 'some thing wrong');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    function topagesdelete($id)
    {
        try {
            $pages = CustomPage::find($id);
            if ($pages->delete()) {
                return redirect()->back()->with('success', 'Page Delete Successfully');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
