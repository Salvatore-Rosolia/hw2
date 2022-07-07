<?php

# UN CONTROLLER E' UNA CLASSE CHE MI RAGGRUPPA DIVERSE ROUTES
# I CONTROLLER VANNO DEFINITI NELL PERCORSO "app/Htpp/Controllers"

# RICORDA DI MODIFICARE "COMPOSER.JSON" RIGA 29
# AGGIORNA DA CMD ALL'INTERNO DELLA PROJECT FOLDER COMANDO -> composer dump-autoload

# IMPORTIAMO LA CLASSE BASE DEL CONTROLLER
use Illuminate\Routing\Controller as BaseController;
use Session;

# IMPORTIAMO LA CLASSE "User"
use App\Models\User;

# DOBBIAMO DEFINIRE UNA CLASSE CHE ESTENDE "BaseController"
class SessionController extends BaseController
{
  # DEFINIAMO IL COMPORTAMENTO DEL CONTROLLER CHE GESTIRA' LA PAGINA "home"

  # IN QUESTO CASO AVREMO SOLAMENTE IL METODO "index"
  # PERCHE' CI INTERESSA SOLO VISUALIZZARE LA PAGINA "home"
  public function index()
  {

    # CONTROLLO SE L'UTENTE E' LOGGATO
    if($request->session()->has('id'))
    {
      return view('home');
    }

    else
    {
        # RITORNIAMO LA VIEW "login"
        return redirect('login');
    }
  }
}
