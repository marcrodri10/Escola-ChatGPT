<?php
include_once 'partials/header.tpl.php'
?>
<!-- Page to show the login-->
<body>
    <?php
    //if we checked the remember button the email and password inputs will be autocompleted automatically.
    if (isset($_COOKIE['remember'])) {
        $userData = unserialize($_COOKIE['remember']);
    }

    ?>
    <div class="container-fluid">
       <?php
        echo generateNavBar($navbarOptions);

        ?>
        <main class="d-flex">
            <form action="loginActionController" class="bg-white p-4 rounded-3 shadow-lg" id="loginForm" method="post">
                <h2 class="form-title">Login</h2>
                <?php
                 //if there is an error we add a div to show the error message and delete the cookie
                if(isset($_COOKIE['login_error'])){
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ".$_COOKIE['login_error']."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                    setcookie('login_error', '', time() -1, '/'); 
                }
                ?>
                <fieldset>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="username-container">
                        
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" <?php if(isset($userData)) echo "value=".$userData['email'];?> required />
                            <label for="username">Email</label>
                        </div>
                        <div class="invalid-feedback" id="username-feedback"></div>
                    </div>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="password-container">
                            <input type="password" class="form-control" name="password" placeholder="Enter password" id="password-form" <?php if(isset($userData)) echo "value=".$userData['password'];?> required />
                            <label for="password-form">Contraseña</label>
                        </div>
                        <div class="invalid-feedback" id="password-feedback"></div>
                    </div>
                    <div class="form-check">
                        <?php 
                        //ask if the remember cookie exists and then we can check the checkbox automatically.
                        if(isset($_COOKIE['remember'])){
                            echo '<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember" id="remember" checked>';
                        }
                        else echo '<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="remember" id="remember">';
                        ?>
                        
                        <label class="form-check-label" for="flexCheckDefault">
                            Recordarme
                        </label>
                    </div>
                    <div class="mb-3">
                        <div class="forgot-password-button text-end">
                            <a href="#" class="text-decoration-none form-text" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">¿Olvidaste tu contraseña?</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Acceder</button>
                    </div>
                    <div class="mb-3 text-center">
                        <p class="form-text">¿No tienes una cuenta? <a href="?url=register" class="link text-decoration-none">Regístrate</a></p>
                    </div>
                </fieldset>
            </form>
        </main>
        <?php

        include_once 'partials/footer.tpl.php'
        ?>
    </div>


</body>

</html>