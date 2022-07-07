
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{url('css/login.css')}}">
    <script src="{{asset('js/registrazione.js')}}" defer></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>

<body>

    <section id="registrazione">


         <h1>Registrati</h1>
        <form enctype="multipart/form-data" method="POST" action="{{ url('/register') }}">
           @csrf
                @if($error == 'empty_fields')
                    <span class='error'>Compilare tutti i campi</span>
                    @elseif($error == 'bad_username')
                 <span class='error'>Username non disponibile </span>
                @endif
                <div id='form_registrazione'>

                <div class="username"><label for='username'>Username</label>
                    <input type="text" name="username" id="username" value='{{ old("username")}}'>
                    <span>Username non valido</span>
                </div>
                <div class="nome"><label for='nome'>Nome</label>
                    <input type="text" name="nome" id="nome"  value='{{ old("nome")}}'>
                    <span>Nome non valido</span>
                </div>
                <div class="cognome"><label for='cognome'>Cognome</label>
                    <input type="text" name='cognome' id='cognome'  value='{{ old("cognome")}}'>
                    <span>Cognome non valido </span>
                </div>
                <div class=" email"><label for='email'>E-mail</label>
                    <input type="text" name='email' id='email'>
                    <span>Email non valida </span>
                </div>
                <div class="password"><label for='password'>Password</label>
                    <input type="password" name="password" id="password">

                    <input type="button" onclick="mostraPass()" id="see_pass">
                    <span>Password non valida </span>
                    <script>
                        function mostraPass() {
                            const input = document.getElementById('password');
                            if (input.type === "password") {
                                input.type = "text";
                                document.getElementById('see_pass').style.backgroundImage = "url(image/occhio_aperto.png)";

                            } else {
                                input.type = "password";
                                document.getElementById('see_pass').style.backgroundImage = "url(image/occhio_chiuso.png)";

                            }
                        }
                    </script>

                </div>
                <div class="dati_file">
                    <input type="hidden" name="MAX_FILE_SIZE" value="524288">
                    <label for="dati_file"> Scegli la tua immagine profilo: </label>
                    <input type="file" name="dati_file"></br>


                </div>

                <div class='start'>
                    <input type="submit" value="Registrati">
                </div>

            </div>
            <div class="login">Hai un account? <a href="{{ url('login') }}">Accedi</a></div>
            </div>



            </div>
        </form>


    </section>

</body>

</html>
