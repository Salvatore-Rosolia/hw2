<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;







class RegisterController extends BaseController
{
    public function register_form()
     {
       /*if(Session::get('iduser'))
       {
         return redirect('home');
       }*/

        $error = Session::get('error');
        Session::forget('error');
        return view('register')->with('error',$error);
    }




    public function check_username($username)
    {

        $check_username = DB::table('profilo')->where('username', '=', $username)->get();

        if(count(json_decode($check_username)) == 0) {
            return json_encode(array('exists' => false));
        } else {
            return json_encode(array('exists' => true));
        }
    }

    public function check_email($email)
    {

        $check_email = DB::table('profilo')->where('email', '=', $email)->get();

        if(count(json_decode($check_email)) == 0) {
            return json_encode(array('exists' => false));
        } else {
            return json_encode(array('exists' => true));
        }
    }

    public function registrazione() {

      if(Session::get('id'))
      {
        return redirect('home');
      }



        // controllo che i campi non siamo vuoti
        if(strlen(request('username')) == 0 || strlen(request('nome')) == 0 ||
         strlen(request('cognome')) == 0 || strlen(request('email')) == 0 ||
         strlen(request('password')) == 0)
         {

            //se sono vuoti reindirizzo alla pagina di registrazione e in più inserisco i dati che sono stati precedentemente inseriti
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
            //Controllo se  username è già esistente
        } else if(User::where('username', request('username'))->first()) {
           Session::put('error', 'bad_username');
           return redirect('register')->withInput();
           // Controllo se l'email è già esistente
        } else if(User::where('email', request('email'))->first()) {
          Session::put('error', 'bad_email');
          return redirect('register')->withInput();
        }

        $file = request()->file('dati_file');
        $filename = date('YmdHi').$file->getClientOriginalName();

        $file-> move(public_path('avatar'), $filename);

        // Creazione UTENTE
        $user = new User;
        $user->username = request('username');
        $user->nome = request('nome');

        $user->cognome = request('cognome');
        $user->password = password_hash(request('password'), PASSWORD_BCRYPT);
        $user->email = request('email');
        $user->image = 'avatar/'.$filename;
        $user->save();
        // login dopo la registrazione

        if($user){
          Session::put('id', $user->id);

          // reindirizzo alla pagina home
          return redirect('home');
}

    }

    public function logout() {
      Session::flush();
      return redirect('login');
    }


}
