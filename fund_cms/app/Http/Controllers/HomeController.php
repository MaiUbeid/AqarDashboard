<?php

namespace App\Http\Controllers;

use App\Models\CategoryImage;
use App\Models\EmailSubscribe;
use App\Models\ImageTag;
use App\Models\SearchKey;
use App\Models\Videos;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use App\Models\Images;
use App\Models\AdminSettings;
use App\Models\Categories;
use App\Models\Query;
use App\Models\Collections;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {





        return view('auth.loginAdmin');

    }// End Method



}
