<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\PageMeta;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function tologinadmin()
    {
        if (Auth::check()) {
            return redirect()->to('/');
        }
        return view('admin.login.login');
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }





    public function index()
    {
        return view('admin.pages.home');
    }

    public function toUser()
    {
        $users = User::paginate(12);
        return view('admin.users.userlist', compact('users'));
    }

    function toUserLogin($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            Auth::guard('web')->login($user);
            return redirect('/user/home')->with('success', 'You are now Impersonating ' . $user->name);
        }
    }

    function toUseredit($id)
    {
        try {
            $user = User::where('id', $id)->first();
            $sponser =  User::where('id', $user->referrer_id)->first();
            return view('admin.users.edit', compact('user', 'sponser'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    function toUserEditUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'unique:users,email,' . $id,
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile_image = $request->profile_image;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->post_code = $request->post_code;
        $user->street_address = $request->street_address;
        $user->bank_name = $request->bank_name;
        $user->account_name = $request->account_name;
        $user->account_number = $request->account_number;
        $user->ifsc_code = $request->ifsc_code;
        $user->front_image = $request->front_image;
        $user->back_image = $request->back_image;
        $user->pan_card = $request->pan_card;
        $user->status = $request->status;

        if ($request->password && ($request->password == $request->confirmpassword)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'User Update Successfully');
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'User Update Successfully');
        }
        return redirect()->back()->with('error', 'User Does Not Exist');
    }

    function toReviews()
    {
        $reviews = Review::with('product')->paginate(12);
        $products = Product::all();

        return view('admin.reviews.reviewlist', compact('reviews', 'products'));
    }

    function toReviewsDelete($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return redirect()->back()->with('success', 'Review Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Review Does Not Exist');
    }
    function toReviewsEdit(Request $request, $id)
    {
        // dd($request->all());
        $review = Review::find($id);
        if ($review) {
            $review->status = $request->status;
            $review->user_name = $request->user_name;
            $review->email = $request->email;
            $review->rate = $request->rate;
            $review->comment = $request->comment;
            $review->save();
            return redirect()->back()->with('success', 'Review Approved Successfully');
        }
        return redirect()->back()->with('error', 'Review Does Not Exist');
    }

    function toReviewsAdd(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'email' => 'required',
            'rate' => 'required',
            'comment' => 'required',
            'product_id' => 'required',
        ]);
        Review::create([
            'user_name' => $request->user_name,
            'email' => $request->email,
            'rate' => $request->rate,
            'comment' => $request->comment,
            'status' => $request->status,
            'product_id' => $request->product_id,
        ]);

        return redirect()->back()->with('success', 'Review Submitted Successfully');
    }

    function topagesmeta()
    {
        $pagemeta = PageMeta::paginate(15);
        return view('admin.meta.pagemeta', compact('pagemeta'));;
    }

    function topagesmetastore(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|unique:page_metas,url',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $pagemeta = new PageMeta;
        $pagemeta->url = $request->url;
        $pagemeta->meta_title = $request->meta_title;
        $pagemeta->meta_keywords = $request->meta_keywords;
        $pagemeta->meta_description = $request->meta_description;
        if ($pagemeta->save()) {
            return redirect()->back()->with('success', 'Added Successfully');
        }
        return redirect()->back()->with('success', 'Added Successfully');
    }

    function topagesmetadelete($id)
    {
        $pagemeta = PageMeta::find($id);
        if ($pagemeta->delete()) {
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('warning', 'Not Deleted');
    }

    function topagesmetastoreedit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'url' => 'unique:page_metas,url,' . $request->id,
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);
        $pageMeta = PageMeta::find($request->id);
        if ($pageMeta) {
            $pageMeta->url = $request->input('url');
            $pageMeta->status = $request->input('status');
            $pageMeta->meta_title = $request->input('meta_title');
            $pageMeta->meta_keywords = $request->input('meta_keywords');
            $pageMeta->meta_description = $request->input('meta_description');
            $pageMeta->save();
            return redirect()->back()->with('success', 'Update Successfully');
        }
        return redirect()->back()->with('warning', 'Not Deleted');
    }

    function toSubscribe()
    {
        $subscribe = Subscribe::paginate(15);
        return view('admin.subscribe.subscribe', compact('subscribe'));
    }

    function toSubscribeStore(Request $request)
    {
        $this->validate($request, [
            'email_id' => 'required|email|unique:subscribes,email_id',
        ]);
        $subscribe = new Subscribe();
        $subscribe->email_id = $request->email_id;
        $subscribe->save();
        return redirect()->back()->with('success', 'Subscribed Successfully');
    }

    function toSubscribeEdit(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'email_id' => 'required|email|unique:subscribes,email_id,' . $request->id,
        ]);
        $subscribe = Subscribe::find($request->id);
        if ($subscribe) {
            $subscribe->email_id = $request->email_id;
            $subscribe->status = $request->status;
            $subscribe->save();
            return redirect()->back()->with('success', 'Updated Successfully');
        }
        return redirect()->back()->with('warning', 'Not Deleted');
    }

    function toSubscribeDelete($id)
    {
        $subscribe = Subscribe::find($id);
        if ($subscribe) {
            $subscribe->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
        return redirect()->back()->with('warning', 'Not Deleted');
    }
}
