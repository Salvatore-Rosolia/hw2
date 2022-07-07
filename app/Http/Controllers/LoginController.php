<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;

class LoginController extends BaseController
{
  public function login_form()
  {
    if(Session::get('id'))
    {
      return redirect('home');
    }
    $error = Session::get('error');
    Session::forget('error');
    return view('login')->with('error', $error);
  }
// login
  public function do_login()
  {
    if(Session::get('id'))
    {
      return redirect('home');
    }

    if(strlen(request('username')) == 0 || strlen(request('password')) == 0)
    {
      Session::put('error', 'empty_fields');
      return redirect('login')->withInput();
    }
    $user = User::where('username',request('username'))->first();
    if(!$user || !password_verify(request('password'), $user->password))
    {
      Session::put('error', 'wrong');
      return redirect('login')->withInput();
    }

    // salvo i dati in sessione
    Session::put('id', $user->id);

    return redirect('home');

  }
}



 ?>
