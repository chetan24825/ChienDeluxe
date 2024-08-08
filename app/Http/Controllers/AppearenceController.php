<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;

class AppearenceController extends Controller
{
    function tofooter()
    {
        return view('admin.appearence.footer');
    }

    function tofooterstore(Request $request)
    {
        BusinessSetting::where('type', 'facebook_link')->update(['value' => $request->facebook_link]);
        BusinessSetting::where('type', 'instagram_link')->update(['value' => $request->instagram_link]);
        BusinessSetting::where('type', 'twitter_link')->update(['value' => $request->twitter_link]);
        BusinessSetting::where('type', 'linkedin_link')->update(['value' => $request->linkedin_link]);
        BusinessSetting::where('type', 'youtube_link')->update(['value' => $request->youtube_link]);
        BusinessSetting::where('type', 'iframe_link')->update(['value' => $request->iframe_link]);
        BusinessSetting::where('type', 'copy_right')->update(['value' => $request->copy_right]);
        BusinessSetting::where('type', 'about_description')->update(['value' => $request->about_description]);
        return redirect()->back()->with('success', 'Update SuccessFully');
    }

    function toheader()
    {
        return view('admin.appearence.header');
    }


    function toheaderstore(Request $request)
    {
        BusinessSetting::where('type', 'comany_email')->update(['value' => $request->comany_email]);
        BusinessSetting::where('type', 'comany_phone')->update(['value' => $request->comany_phone]);
        BusinessSetting::where('type', 'comany_address')->update(['value' => $request->comany_address]);
        BusinessSetting::where('type', 'web_logo')->update(['value' => $request->web_logo]);
        BusinessSetting::where('type', 'meta_title')->update(['value' => $request->meta_title]);
        BusinessSetting::where('type', 'meta_keywords')->update(['value' => $request->meta_keywords]);
        BusinessSetting::where('type', 'meta_description')->update(['value' => $request->meta_description]);
        BusinessSetting::where('type', 'latest_news')->update(['value' => $request->latest_news]);
        return redirect()->back()->with('success', 'Update SuccessFully');
    }

    function toslider()
    {
        $sliders = Slider::paginate(30);
        return view('admin.slider.slider', compact('sliders'));
    }

    function tosliderstore(Request $request)
    {
        $this->validate($request, [
            'slider_image' => 'required',
        ]);

        $slider = new Slider();
        $slider->slider_title = $request->slider_title;
        $slider->slider_link = $request->slider_link;
        $slider->slider_description = $request->slider_description;
        $slider->slider_image = $request->slider_image;
        if ($slider->save()) {
            return redirect()->back()->with('success', 'Slider Added SuccessFully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    function tosliderdelete($id)
    {
        $slider = Slider::find($id);
        if ($slider->delete()) {
            return redirect()->back()->with('success', 'Slider Deleted SuccessFully');
        } else {
            return
                redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    function tosliderupdate(Request $request)
    {
        $this->validate($request, [
            'slider_image' => 'required',
        ]);
        $slider = Slider::find($request->id);
        $slider->slider_title = $request->slider_title;
        $slider->slider_link = $request->slider_link;
        $slider->status = $request->status;
        $slider->slider_description = $request->slider_description;
        $slider->slider_image = $request->slider_image;
        if ($slider->save()) {
            return redirect()->back()->with('success', ' Updated SuccessFully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    /** Attribute */
    function toAttribute()
    {
        $sliders = Attribute::paginate(30);
        return view('admin.attribute.attribute', compact('sliders'));
    }

    function toAttributestore(Request $request)
    {
        $this->validate($request, [
            'attribute_name' => 'required|unique:attributes,attribute_name|max:255',
        ]);

        $check = Attribute::where('attribute_name', $request->attribute_name)->first();
        if ($check) {
            return redirect()->back()->with('error', ' Already been taken. ');
        }

        $attribute = new Attribute();
        $attribute->attribute_name = $request->attribute_name;
        $attribute->attribute_slug = Str::slug($request->attribute_name);
        if ($attribute->save()) {
            return redirect()->back()->with('success', ' Added SuccessFully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    function toAttributedelete($id)
    {
        $attribute = Attribute::find($id);
        if ($attribute->products()->count() > 0) {
            return redirect()->back()->with('error', 'Can not Delete Because This Attribute is been used in product');
        }
        if ($attribute->delete()) {
            return redirect()->back()->with('success', 'Deleted SuccessFully');
        } else {
            return
                redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    function toAttributeupdate(Request $request)
    {
        $this->validate($request, [
            'attribute_name' => 'required|unique:attributes,attribute_name,' . $request->id,
        ]);

        $attribute = Attribute::find($request->id);
        $attribute->attribute_name = $request->attribute_name;
        $attribute->attribute_slug = Str::slug($request->attribute_name);
        $attribute->attribute_status = $request->attribute_status;
        if ($attribute->save()) {
            return redirect()->back()->with('success', ' Updated SuccessFully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
}
