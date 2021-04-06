<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // users
    public function index()
    {
       $users=User::where('id','!=',Auth::user()->id)->paginate(16);
       return view('salfny.users.index',\compact('users'));
    }
}