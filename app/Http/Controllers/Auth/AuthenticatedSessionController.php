<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Theme;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $theme = Theme::find(['active' => true])->first();

        return view("themes.$theme->slug.template.login");
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

//        $request->session()->regenerate();
            $checkout =  session()->get('checkout');
            if($checkout){
                return redirect()->route('checkout');
            }
        return redirect()->route('user.dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function googleSignup(Request $request){
        $googleUser = Socialite::driver('google')->user();
        $gId = $googleUser->getId();
        $gName = $googleUser->getName();
        $gImage =  $googleUser->getAvatar();
        $gEmail = $googleUser->getEmail();

        $user = \App\Models\User::where('email', $gEmail)->first();
        if(!$user){
            $user = \App\Models\User::create([
                'name' => $gName,
                'email' => $gEmail,
                'password' => bcrypt('password@12345'),
            ]);
            $user->config = [
                'googleId' => $gId,
                'avatar' => $gImage,
            ];
            $user->email_verified_at = Carbon::now()->toDateTimeString();

            $user->save();
        }
        Auth::login($user);

        return redirect()->route('user.dashboard');

    }

    public function facebookSignup(){
        $facebookUser = Socialite::driver('facebook')->user();
        $gId = $facebookUser->getId();
        $gName = $facebookUser->getName();
        $gImage =  $facebookUser->getAvatar();
        $gEmail = $facebookUser->getEmail();

        $user = \App\Models\User::where('email', $gEmail)->first();
        if(!$user){
            $user = \App\Models\User::create([
                'name' => $gName,
                'email' => $gEmail,
                'password' => bcrypt('password@12345'),
            ]);
            $user->config = [
                'googleId' => $gId,
                'avatar' => $gImage,
            ];
            $user->email_verified_at = Carbon::now()->toDateTimeString();

            $user->save();
        }
        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}
