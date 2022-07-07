<hmtl>

    <head>
        <title>Together</title>
        <link rel="stylesheet" href='{{ url("css/home.css") }}'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.min.css" integrity="sha512-fJcFDOQo2+/Ke365m0NMCZt5uGYEWSxth3wg2i0dXu7A1jQfz9T4hdzz6nkzwmJdOdkcS8jmy2lWGaRXl+nFMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script> const BASE_URL = "{{ url ('/') }}/"</script>
        <script src='{{ url("js/home.js") }}' defer></script>
        <script src='{{ url("js/post_content.js") }}' defer></script>
        <script src='{{ url("js/post_show.js") }}' defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,wght@1,600&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital@1&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital@1&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <header>
        <nav id='barra'>
<div class='barra_sinistra'>
    <img src="{{ url('image/together.png')}}">
<h1>Together</h1>


</div>
<div class='barra_destra'>
<form id ='form_search' method='GET' name='cerca_persone'>
<input id='testo' name='cerca_username' type='text' placeholder='cerca persone' >
<input type ='submit' value='Cerca' id='cerca'>
</form>

<div id="user_case"><img class="img_case" src="{{asset($user['image'])}}"></div>
<a href="{{ url ('logout')}}" id='logout'><h2> Logout </h2></a>
</div>
            </nav>
        </header>

        <div id="colonna_destra" class ='hidden'>

            <div id="chat_box">

            </div>




        </div>

        <div id="corpo">

        <div id="new_post">
                    <div id="img_profile" style="background-image:url({{ asset($user['image'])}})">  </div>
                    <div id="text">
                        <form action="{{ url('/new_post')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                            <input type="text" id="testo" name="testo" cols="4" placeholder="A cosa stai pensando?"> </textarea>
                            <div id="preview" class="hidden"></div>
                            <input type='hidden' id='idbrano' name='idbrano' value =''>
                            <div id="option" >
                            <label><input type="radio" name="tipo" id="spotify" value="spotify"> Musica</label>
                            <label><input type="radio" name="tipo" id="img" value="image"> Foto</label>

                            </div>
                            <div id= "search_music" class ="hidden">


                                <input type="text" id='title' placeholder="cerca il contenuto">
                                <input type="submit" id="c_s" value="cerca">
                            </div>
                            <div id="load_image" class="hidden">
                            <input type="hidden" name="MAX_FILE_SIZE" value="99999999999">
                            <input type="file" id="image" name="image"></br>
                            </div>

                            <input id="post" type="submit" value="Post"></div>
                        </form>
                    </div>
<div id="spotify_show">


</div>
                <div id="posts">
                    <div id="box_post" class="hidden" >
                      <div class="top_post">
                        <div class="con_avatar_post"><img class = "avatar_post" src=""></div>
                        <div class="con_username_data">
                          <div class="con_username_post"></div>
                          <div class="con_data"></div>
                        </div>
                      </div>
                      <div class="con">
                        <div class="con_testo"></div>
                        <div class="con_content"></div>
                      </div>
                      <div class="bot_post">
                        <div class="con_likes">

                        </div>
                        <div class="con_comments"> <img src="image/comments.png"></div>
                      </div>
                      <section class='hidden'>
                        <div class="box_comm">
                          <form method = "POST" action="add_comment">
                            @csrf
                            <input type="hidden" name="segno">
                            <input type="text" name="text_comment">
                            <input type="submit" name="submit" value="Commenta">
                          </form>

                        </div>
                        <div class="box_allcomm"></div>
                      </section>
                    </div>
            </div>
        </div>
        <section id="view_users" class="hidden">




        </section>

        <section id="box_chat" class ="hidden">
          <div class="top_chat">
            <div class="con_img_chat"> <img class="img_chat"></div>
            <div class="con_name_chat"> <h3></h3></div>
            <div class="con_azioni_chat">
                <button class="close_chat">X</button>
                <div class="load_chat">
                  <img src = "image/reload.png">
                </div>

              </div>


          </div>
          <div id="con_messaggi">
            <h1 class="no_mess"> Non ci sono messaggi</h1>
          </div>
          <form id="send_mess" method="GET">
            @csrf
            <input type="text" name="mess" id="mess">
            <input type="submit" name="invia_mess" id="invia_mess">


          </form>

        </section>



        <footer id="fine">
            <div id="end">
                <a>Autore: Salvatore Rosolia </a>
                <a>Matricola: O46001354</a>
                <a>Corso: Web Programming 2021/22</a>
            </div>
        </footer>


    </body>
</hmtl>
