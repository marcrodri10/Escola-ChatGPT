<?php
    include_once 'partials/header.tpl.php'
?>
<!-- Register page-->
<body>
    <div class="container-fluid">
        <?php
            echo generateNavBar($navbarOptions);
        ?>
        <main class="d-flex">
            <form action="registerActionController" class="bg-white p-4 rounded-3 shadow-lg" id="registerForm" method="post">
                <h2 class="form-title">Register</h2>
                <?php
                //if there is an error we add a div to show the error message and delete the cookie
                if(isset($_COOKIE['register_error'])){
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ".$_COOKIE['register_error']."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                    setcookie('register_error', '', time() -1, '/'); 
                }
                ?>
                <!-- form inputs-->
                <fieldset>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="username-container">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
                            <label for="name">Nombre</label>
                        </div>
                        <div class="invalid-feedback" id="username-feedback"></div>
                    </div>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="username-container">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" autocomplete="email" required />
                            <label for="lastname">Apellidos</label>
                        </div>
                        <div class="invalid-feedback" id="username-feedback"></div>
                    </div>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="username-container">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="email" required />
                            <label for="email">Email</label>
                        </div>
                        <div class="invalid-feedback" id="username-feedback"></div>
                    </div>
                    <div class="input-group mb-3 has-validation">
                        <div class="form-floating" id="password-container">
                            <input type="password" class="form-control" name="password" placeholder="Enter password" autocomplete="current-password" id="password-form" required />
                            <label for="password-form">Contraseña</label>
                        </div>
                        <div class="invalid-feedback" id="password-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Acceder</button>
                    </div>
                    <div class="mb-3 text-center">
                        <p class="form-text">¿Ya tienes una cuenta? <a href="?url=login" class="link text-decoration-none">Login</a></p>
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