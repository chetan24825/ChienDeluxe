<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function totestimonial()
    {
        return view('admin.testimonial.testimonial');
    }



    public function createTestimonial(Request $request)
    {
        $this->validate($request, [
            "user_name" => 'required|string',
            "rating" => 'required|numeric',
            "photos" => 'required',
            "content" => 'required',
        ]);
        $testimonial = new Testimonial;
        $testimonial->user_name = $request->user_name;
        $testimonial->status = $request->status;
        $testimonial->rate = $request->rating;
        $testimonial->image = $request->photos;
        $testimonial->content = $request->content;
        if ($testimonial->save()) {
            return redirect()->back()->with('success', "Create Successfully");
        } else {
            return redirect()->back()->with('error', "Cannot Create Successfully");
        }
    }


    public function listTestimonial()
    {
        $testimonial = Testimonial::paginate(10);
        return view('admin.testimonial.testimonial_list', compact('testimonial'));
    }

    public function editTestimonial(Request $request)
    {
        $this->validate($request, [
            'service_id' => "required",
            "user_name" => 'required|string',
            "rating" => 'required|numeric',
            "photos" => 'required',
            "content" => 'required',
        ]);
        $testimonial = Testimonial::find($request->service_id);
        $testimonial->user_name = $request->user_name;
        $testimonial->status = $request->status;

        $testimonial->rate = $request->rating;
        $testimonial->image = $request->photos;
        $testimonial->content = $request->content;
        if ($testimonial->save()) {
            return redirect()->back()->with('success', "Edit Successfully");
        } else {
            return redirect()->back()->with('error', "Cannot Edit Successfully");
        }
    }

    public function totestimonialdelete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->delete()) {
            return redirect()->back()->with('success', 'Testimonial Delete Successfully');
        } else {
            return redirect()->back()->with('error', 'This Testimonial Cannot Delete');
        }
    }
}
