<?php

namespace App\Http\Controllers\Auth;

use App\Events\PointValueTransaction;
use App\Http\Controllers\Controller;
use App\Models\PointValue;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'phone_number' => 'required|min:10'
        ]);

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]));

        $reference = $request->reference ?? session()->get('reference');

        event(new PointValueTransaction($user, PointValue::SCHEME_SELF_REGISTERED, $reference));

        event(new Registered($user));
        $checkout =  session()->get('checkout');
        if($checkout){
            return redirect()->route('checkout');
        }

        return redirect()->route('user.dashboard');
    }
}
