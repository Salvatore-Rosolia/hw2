<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <script src="{{asset('js/login.js')}}" defer></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="{{url('css/login.css')}}">


</head>

<body>
    <section id="login">
        <h2>Login</h2>

        <form name="login" method="POST" action= "{{ url('/login')}}">
          @csrf
            <div id="form_login">
              @if($error == 'empty_fields')
              <span class="error">Inserire credenziali!</span>
              @elseif($error == 'wrong')
              <span class="error">Password Errata!</span>
              @endif
                <div class="username">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username">
                    <span>Nome non valido</span>

                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                    <input type="button" onclick="mostraPass()" id="see_pass" >
                    <span>Password non valida</span>
                        <script>
                            function mostraPass() {
                                const input = document.getElementById('password');
                                if(input.type === "password") {
                                    input.type = "text";
                                    document.getElementById('see_pass').style.backgroundImage = "url(image/occhio_aperto.png)";

                                } else {
                                    input.type = "password";
                                    document.getElementById('see_pass').style.backgroundImage = "url(image/occhio_chiuso.png)";

                                }
                            }
                        </script>

                        </div>
                <div>
                    <input type="submit" value="Login">
                </div>
                <div class="registrazione">Non hai un account? <a href="{{ url('register')}}">Iscriviti</a></div>
            </div></div>
        </form>



    </section>






</body>

</html>
