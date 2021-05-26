<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/bank/login';
    protected $redirectToAdmin = 'bank/dashboard';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'logout']);
    }



    public function loginAdmin(Request $request)
    {




        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            return $this->sendLoginResponseAdmin($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    protected function sendLoginResponseAdmin(Request $request)
    {



        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPathAdmin());



    }


    public function redirectPathAdmin()
    {
        if (method_exists($this, 'redirectToAdmin')) {
            return $this->redirectToAdmin();
        }

        return property_exists($this, 'redirectToAdmin') ? $this->redirectToAdmin : '/bank/dashboard';
    }



    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return trans('auth.error_logging');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        //  $request->session()->invalidate();
        //   $lang=   \Session::get('locale');


        //  return redirect()->back();
        return $this->loggedOut($request) ?: redirect('bank/login');
    }


    public function showLoginFormAdmin()
    {
        return view('auth.loginAdmin');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

}
