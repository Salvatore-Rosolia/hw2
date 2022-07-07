<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <script src="<?php echo e(asset('js/login.js')); ?>" defer></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="<?php echo e(url('css/login.css')); ?>">


</head>

<body>
    <section id="login">
        <h2>Login</h2>

        <form name="login" method="POST" action= "<?php echo e(url('/login')); ?>">
          <?php echo csrf_field(); ?>
            <div id="form_login">
              <?php if($error == 'empty_fields'): ?>
              <span class="error">Inserire credenziali!</span>
              <?php elseif($error == 'wrong'): ?>
              <span class="error">Password Errata!</span>
              <?php endif; ?>
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
                <div class="registrazione">Non hai un account? <a href="<?php echo e(url('register')); ?>">Iscriviti</a></div>
            </div></div>
        </form>



    </section>






</body>

</html>
<?php /**PATH C:\xampp\htdocs\hw2-app\resources\views/login.blade.php ENDPATH**/ ?>