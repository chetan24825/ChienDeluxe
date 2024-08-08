<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginPage extends Component
{
    use AuthenticatesUsers;
    public $email;
    public $password;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function render()
    {
        return view('livewire.login-page');
    }

    public function login()
    {
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (User::where('email', $this->email)->first()) {
            if (Auth::attempt($validated)) {
                product_cart();
                return redirect()->intended($this->redirectPath());
            }
        }
        session()->flash('error', 'Invalid email or password.');
    }

    private function redirectPath()
    {
        return $this->redirectTo ?: route('home');
    }
}
