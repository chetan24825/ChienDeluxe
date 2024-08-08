<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;


class UserController extends Controller
{


    function toprofile()
    {
        $sponser =  User::where('id', Auth::user()->referrer_id)->first();
        return view('user.userprofile.userprofile', compact('sponser'));
    }

    function toprofileedit(Request $requset)
    {
        $this->validate($requset, [
            'email' => 'unique:users,email,' . Auth::user()->id,
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $requset->name;
        $user->email = $requset->email;
        $user->profile_image = $requset->profile_image;
        // $user->country = $requset->country;
        $user->mobile = $requset->mobile;
        $user->state = $requset->state;
        $user->city = $requset->city;
        $user->post_code = $requset->post_code;
        $user->street_address = $requset->street_address;
        $user->bank_name = $requset->bank_name;
        $user->account_name = $requset->account_name;
        $user->account_number = $requset->account_number;
        $user->ifsc_code = $requset->ifsc_code;
        $user->front_image = $requset->front_image;
        $user->back_image = $requset->back_image;
        $user->pan_card = $requset->pan_card;

        if ($requset->password && ($requset->password == $requset->confirmpassword)) {
            $user->password = Hash::make($requset->password);
            $user->save();
            return redirect()->back()->with('success', 'User Update Successfully');
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'User Update Successfully');
        }
        return redirect()->back()->with('error', 'User Does Not Exist');



        // [
        //     "name" => "Chetan",
        //     "email" => "chetan@gmail.com",
        //     "country" => "India",
        //     "state" => "Punjab",
        //     "city" => "Amritsar",
        //     "post_code" => "143001",
        //     "street_address" => "Loghar Gate,amritsar",
        //     "bank_name" => "Central Bank Of India",
        //     "account_name" => "Chetan Kumar",
        //     "account_number" => "3028995651",
        //     "ifsc_code" => "2229999999",
        //     "front_image" => "109",
        //     "back_image" => "109",
        //     "pan_card" => "109"
        // ];

        dd($requset->all());
    }


    // public function tolistlevel()
    // {
    //     $levelId = 1;
    //     $myReferral = showBelow(Auth::id());
    //     $nextArray = $myReferral;

    //     for ($i = 1; $i < $levelId; $i++) {
    //         $nextArray = array();
    //         foreach ($myReferral as $underRefer) {
    //             $newdata = showBelow($underRefer);
    //             $nextArray = array_merge($nextArray, $newdata);
    //         }
    //         $myReferral = $nextArray;
    //     }
    //     $level = Level::all();
    //     return view('user.comission.levels', compact('myReferral', 'level'));
    // }


    public function tolistlevel(Request $request)
    {
        $levelId = $request->level;
        $user = Auth::user();

        if ($levelId > 10) {
            return back()->with('error', 'No Level Found.');
        }
        $myReferral = showBelow($user->id);
        $nextArray = $myReferral;
        for ($i = 1; $i < $levelId; $i++) {
            $nextArray = array();
            foreach ($myReferral as $underRefer) {
                $newdata = showBelow($underRefer);
                $nextArray = array_merge($nextArray, $newdata);
            }
            $myReferral = $nextArray;
        }
        $level = Level::all();
        $perPage = 12;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $data = array_slice($myReferral, $offset, $perPage);
        $paginator = new LengthAwarePaginator($data, count($myReferral), $perPage, $page);
        $currentLevel = $request->input('level');
        $paginator->appends(['level' => $currentLevel]);
        $paginator->setPath(route('user.level'));
        return view('user.comission.levels', [
            'data' => $paginator,
            'levelId' => $currentLevel,
            'level' => $level,
            'currentLevel' => $currentLevel
        ]);
    }

    function todirectreffer()
    {
        $direct_reffer = User::where('referrer_id', Auth::user()->id)->paginate(12);
        return view('user.comission.directreffer', compact('direct_reffer'));
    }




    function toorder()
    {
        $orders = Order::orderby('id', "DESC")->where('user_id', Auth::user()->id)->paginate(12);
        return view('user.orders.order', compact('orders'));
    }

    function toorderview($id)
    {
        $order = Order::find(decrypt($id));
        return view('user.orders.view', compact('order'));
    }

    public function withdrawalRequest(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|max:' . Auth::user()->balance,
        ], [
            'amount.max' => 'You do not have sufficient balance to withdraw this amount.',
        ]);

        $requestedAmount = (float) $request->amount;

        $pendingAmount = Withdrawal::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->sum('amount');

        $totalWithdrawalAmount = $pendingAmount + $requestedAmount;

        if ($totalWithdrawalAmount > Auth::user()->balance) {
            return redirect()->back()->with('error', 'You do not have sufficient balance to withdraw this amount.');
        }

        try {
            $withdrawal = new Withdrawal();
            $withdrawal->transaction_id = getTrx();
            $withdrawal->user_id = Auth::user()->id;
            $withdrawal->amount = $requestedAmount;
            $withdrawal->balance_amount = (Auth::user()->balance - $totalWithdrawalAmount);
            $withdrawal->save();

            Transaction::create([
                'message' => 'Withdrawal Request Pending of ' . Auth::user()->user_name,
                'user_id' => Auth::user()->id,
                'trans_id' => getTrx(),
                'description' => 'User Withdraw Pending Request ' . Auth::user()->user_name,
                'amount' => $requestedAmount,
                'withdrawal_id' => $withdrawal->id,
                'symbol' => '-',
                'old_bal' => Auth::user()->balance,
                'new_bal' => Auth::user()->balance - $totalWithdrawalAmount,
                'status' => 2, //withdrawal
            ]);

            return redirect()->back()->with('success', 'Your withdrawal request has been submitted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'An error occurred while processing your withdrawal request. Please try again later.');
        }
    }


    function towithdrawal()
    {
        // $withdrawal = Withdrawal::where('user_id', Auth::user()->id)->with('user')->paginate(20);
        $withdrawal = Withdrawal::where('user_id', Auth::user()->id)->paginate(20);
        return view('user.withdrawal.withdrawal', compact('withdrawal'));
    }

    function totransaction()
    {
        $transacrtion = Transaction::where('user_id', Auth::id())->orderby('id', 'desc')->paginate(30);
        return view('user.withdrawal.transaction', compact('transacrtion'));
    }

    function torewards()
    {
        return view('user.rewards.reward');
    }


}
