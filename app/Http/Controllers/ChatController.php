<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Chat;
use App\Models\Message;



class ChatController extends BaseController {


  // funzione che controlla se la chat esiste
  function check_chat($iduser)
    {
      if(!Session::get('id'))
      {
        return redirect('login');
      }
        $try1 = DB::table('chats')->where('user1', '=', Session::get('id'))->where('user2', '=', $iduser)->get();
        $count1 = count(json_decode($try1));
        if($count1 == 0) {
          $try2 = DB::table('chats')->where('user1', '=', $iduser)->where('user2', '=', Session::get('id'))->get();
          $count2 = count(json_decode($try2));
          if($count2 == 0 ) {
            return json_encode($arrayName = array('exists' => false, 'dati' => $iduser));
          } else
            return  json_encode($arrayName = array('exists' => true, 'dati' => $try2));
        } else return  json_encode($arrayName = array('exists' => true, 'dati' => $try1));
    }

    // funzione che crea la nuova chat nel DB
    function create_chat_db($iduser)
    {
      if(!Session::get('id'))
      {
        return redirect('login');
      }

        $chat = new Chat;
        $chat->user1 = Session::get('id');
        $chat->user2 = $iduser;
        $chat->save();

        return json_encode($arrayName = array('exists' => true, 'dati' => $chat));

    }



    // funzione che cerca la persona con cui voglio chattare

    function  cerca_persone($usd)
    {
      if(!Session::get('id'))
      {
        return redirect('login');
      }

      $result = DB::table('profilo')->select('id','image',  'username')->where('id', '=', $usd)->get();

      return $result;
    }

// funzione che carica i messaggi della chat
    function chat($idchat)
    {
      if(!Session::get('id'))
      {
        return redirect('login');
      }

        $result = DB::table('messages')->leftjoin('profilo', 'messages.iduser', '=', 'profilo.id')->where('messages.idchat','=',$idchat)->select('messages.id', 'messages.time', 'messages.text', 'profilo.username', 'profilo.image', 'profilo.id')->orderBy('messages.id', 'desc')->get();

        return $result;

    }


    function send_mess($idch,$mess)
    {
      if(!Session::get('id'))
      {
        return redirect('login');
      }

      $messag = new Message;
      $messag->idchat = $idch;
      $messag->iduser = Session::get('id');
      $messag->text = $mess;

      $messag->save();

      return json_encode($arrayName = array('exists' => true, 'idchat' => $idch));

    }





}

?>
