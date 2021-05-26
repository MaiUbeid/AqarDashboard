<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Rules\Captcha;
use Validator;
use App\Models\AdminSettings;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

     
        $messages = [
            "letters" => trans('validation.letters')
        ];

        Validator::extend('ascii_only', function ($attribute, $value, $parameters) {
            return !preg_match('/[^x00-x7F\-]/i', $value);
        });

        // Validate if have one letter
        Validator::extend('letters', function ($attribute, $value, $parameters) {
            return preg_match('/[a-zA-Z0-9]/', $value);
        });
        \Config::set('database.default', 'mysqlUser');
    return Validator::make($data, [
            'name'             => 'required|min:3',
            'email'                => 'required|email|max:255|unique:users',
            'password'             => 'required|min:6|confirmed',
            'agree_gdpr'           => 'required',
        ], $messages);
    }

    public function showRegistrationForm()
    {

        $settings = AdminSettings::first();

        if ($settings->registration_active == 1) {
            return view('auth.register');
        } else {
            return redirect('/');
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
       
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        \Config::set('database.default', 'mysql');

        $settings = AdminSettings::first();
      

        // Verify Settings Admin
        $_username=explode( '@', strtolower($data['email']) )[0];
        $_username= $_username.rand(10,100);

        while($this->user_is_exsit($_username)){
        $_username= $_username.rand(10,100);
        }


        if ($settings->email_verification == '1') {

            $confirmation_code = str_random(100);
            $status = 'pending';

            //send verification mail to user
            $_email_user = $data['email'];
            $_title_site = $settings->title;
            $_email_noreply = $settings->email_no_reply;

           
          
            Mail::send('emails.verify', ['confirmation_code' => $confirmation_code],
                function ($message) use (
                    $_username,
                    $_email_user,
                    $_title_site,
                    $_email_noreply
                ) {
                    $message->from($_email_noreply, $_title_site);
                    $message->subject(trans('users.title_email_verify'));
                    $message->to($_email_user, $_username);
                });

        } else {
            $confirmation_code = '';
            $status = 'active';
        }
      
       
        $token = str_random(75);
  
        return User::create([
            'username'        => $_username,
            'name'            => $data['name'],
            'bio'             => '',
            'password'        => bcrypt($data['password']),
            'email'           => strtolower($data['email']),
            'avatar'          => 'default.jpg',
            'cover'           => 'cover.jpg',
            'status'          => $status,
            'type_account'    => '1',
            'website'         => '',
            'twitter'         => '',
            'paypal_account'  => '',
            'activation_code' => $confirmation_code,
            'oauth_uid'       => '',
            'oauth_provider'  => '',
            'token'           => $token,
        ]);
    }

    // check userName is exsit
   public function user_is_exsit($userName){
    $user=User::where('username',$userName)->first();
    return isset($user);
   }
}
