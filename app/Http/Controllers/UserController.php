<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function get(Request $request)
    {
      dd('test');
      $user_id = Auth::id();
      $user = User::find($user_id);
      return $user;
    }
}