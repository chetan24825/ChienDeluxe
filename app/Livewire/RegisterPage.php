<?php

namespace App\Livewire;

use App\Mail\WelcomeEmail;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;

#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;
    public $username;
    public $user_name;
    public $password_confirmation;
    public $phone;
    public $referral_id;
    public $sponsorId = null;
    public $userFromUrl;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
            'user_name' => 'required|min:4|max:255|alpha_dash|unique:users,user_name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
        ];
    }


    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'user_name' => $this->user_name,
            'mobile' => $this->phone,
            'referrer_id' => null,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Mail::to($user)->send(new WelcomeEmail($user, $this->password));
        auth()->login($user);
        return redirect('/user/home')->with('success', 'You are now Impersonating ' . $user->name);
    }


    public function render()
    {
        return view('livewire.register-page');
    }
}
