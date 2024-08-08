<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Referral;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'referrer_id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $exist = User::where('user_name', $data['sponsorid'])->first();
        if (!$exist) {
            return back()->with('error', 'The sponsor id doesn\'t exists');
        }


        return User::create([
            'name' => $data['name'],
            'referrer_id' => $exist->id,
            'email' => $data['email'],
            'mobile' => $data['phone1'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    function registeruser(Request $request)
    {
        $this->validate($request, [
            'referrer_id' => 'nullable|string|exists:users,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        if ($request->sponsorid) {
            $exist = User::where('user_name', $request->sponsorid)->first();
            
            if (!$exist) {
                return redirect()->back()->with('error', 'The sponsor id doesn\'t exist');
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->referrer_id = $exist->id ?? 1;
        $user->email = $request->email;
        $user->mobile = $request->phone1;
        $user->password = Hash::make($request->password);
        $user->save();
        
        $referralId = $request->input('referrer_id') ?? null;
        
        if ($referralId) {
            Referral::create([
                'user_id'=>$user->id,
                'referral_id' => $referralId,
            ]);
        }
            
        $idpre = 10000;
        $profileID = $idpre + $user->id;
        User::whereId($user['id'])->update([
            'user_name' => 'EWC' . $profileID,
        ]);

        Auth::guard('web')->login($user);
        return redirect('/user/home')->with('success', 'You are now Impersonating ' . $user->name);
    }
}
