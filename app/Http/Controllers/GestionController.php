<?php
namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;





class GestionController extends BaseController {

// Funzione che mostra i posts
  public function home()
  {
    if(!Session::get('id')) // controllo che la variabile di sessione che identifica un utente sia settata
    {
      return redirect('login'); // se non è settata lo reindirizzo al login
    }

    // Leggo l'UTENTE
    $user = User::find(Session::get('id'));

    return view('home')->with('user', $user);
  }

  public function show_post()
  {
    // controllo il login

    if(!Session::get('id'))
    {
      return redirect('login');
    }

    // leggo tutti i post
    $like = DB::table('likes')->get();
    $posts = DB::table('posts')->join('profilo', 'posts.user', '=', 'profilo.id')->select('posts.*', 'profilo.username', 'profilo.image')->orderBy('posts.id', 'desc')->get();

    echo json_encode(array('posts' => $posts, 'likes' => $like));

    }

// funzione che dopo il click visualizza tutti i commenti di quel post
    public function show_comments($idp)
     {
      // controlla che la sessione è aperta altrimenti rimanda al login
      if(!Session::get('id'))
      {
        return redirect('login');
      }
        $comments= DB::table('comments')->join('profilo', 'comments.user', '=', 'profilo.id')->select('comments.*', 'profilo.username', 'profilo.image')->where('comments.post', '=', $idp)->get();
        return $comments;

    }
    // funzione che aggiunge un commento al post
    public function add_comment()
    {
      // controlla che la sessione è aperta altrimenti rimanda al login
      if(!Session::get('id'))
      {
        return redirect('login');
      }



        $user = Session::get('id');
        $post = request('segno');
        $text = request('text_comment');
        $comment = new Comment;
        $comment->user = $user;
        $comment->post = $post;
        $comment->text = $text;
        $comment->save();

        return redirect('home');
    }


// funzione per cancellare un commento
    public function remove_comment($idc)
      {
        // controlla che la sessione è aperta altrimenti rimanda al login
        if(!Session::get('id'))
        {
          return redirect('login');
        }
          // cancella la riga corrispondente dalla tabella comments

        $deleted = DB::table('comments')->where('id', '=', $idc)->delete();

        return json_encode(array('exists' => true, 'id' => $idc));
      }

    public function search($title)
      {
        //Controllo se l'utente è LOGGATO
        if(!Session::get('id'))
        {
          return redirect('login');
        }
        // ricerca canzoni
        //variabili utili

        /*$client_id = env(SPOTIFY_CLIENT_ID);
        $client_secret = env(SPOTIFY_CLIENT_SECRET);*/
        $client_id = "ab491bcc1c46484e9bb5a9e2af879120";
        $client_secret = "53c266f3dd944cf88ef073445e3141b0";
        // ACCESS TOKEN
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la POST
        curl_setopt($ch, CURLOPT_POST, 1);
        # Setto body e header della POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret)));
        $token=json_decode(curl_exec($ch), true);
        curl_close($ch);




        // QUERY EFFETTIVA

        $query = urlencode($title);
        $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Imposto il token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token']));
        $res=curl_exec($ch);
        curl_close($ch);

        return $res;

      }

      public function new_post()
      {
        //Controllo se l'utente è LOGGATO
        if(!Session::get('id'))
        {
          return redirect('login');
        }

        if(request('tipo') == "image" && (request()->file('image') != null)) {

          $image= request()->file('image');
          $image_extension = $image->extension();
          $imagename = date('YmdHi').$image->getClientOriginalName();
          $image-> move(public_path('post_images'), $imagename);
          $type = request('tipo');
          $text = request('testo');
          $ele = 'post_images/'.$imagename;
          $id = Session::get('id');

          $post = new Post;
          $post->user = $id;
          $post->type = $type;
          $post->text = $text;
          $post->ele = $ele;
          $post->save();
        } if(request('tipo') == "spotify" && request('idbrano') != null)
         {


           $type = request('tipo');
           $text = request('testo');
           $ele = request('idbrano');
           $id = Session::get('id');

           $post = new Post;
           $post->user = $id;
           $post->type = $type;
           $post->text = $text;
           $post->ele = $ele;
           $post->save();
         }
        if(Session::get('id'))
        {
          return redirect('home');
        }

      }

        // funzione che carica l'user case
      function load_user_case()
      {
        //Controllo se l'utente è LOGGATO
        if(!Session::get('id'))
        {
          return redirect('login');
        }

        $user_case = DB::table('profilo')->select('id', 'image', 'username')->where('id', '=', Session::get('id'))->get();
        return $user_case;
      }



    function add_like($idp)
    {
      //Controllo se l'utente è LOGGATO
      if(!Session::get('id'))
      {
        return redirect('login');
      }
        $add = new Like;

        $add->post = $idp;
        $add->user = Session::get('id');
        $add->save();

        return $add;
    }


    //Funzione per rimuovere il like

    function remove_like($box)
    {
      //Controllo se l'utente è LOGGATO
      if(!Session::get('id'))
      {
        return redirect('login');
      }

      $delet = DB::table('likes')->where('user','=', Session::get('id'))->where('post', '=', $box)->delete();
      return json_encode(array('exists' => true, 'idp' => $box));


    }


    // Funzione che cerca gli utenti

    function search_people($username)
     {
       //Controllo se l'utente è LOGGATO
       if(!Session::get('id'))
       {
         return redirect('login');
       }

       $result = DB::table('profilo')->select('id','image',  'username', 'nposts')->where('username', 'like', '%'.$username.'%')->whereNot('id', '=', Session::get('id'))->get();

       return $result;
     }



}


 ?>
