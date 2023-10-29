<?php

    require 'conexion.php';
    require 'src/translations.php';

    //chec if the inputs are not empty
    if ((isset($_POST['email']) && isset($_POST['password']))) {

        //sanitize input values
        if(isset($_POST['email']) && isset($_POST['password'])){
            filter_input(INPUT_POST, $_POST['email'], FILTER_SANITIZE_EMAIL); //limpia la cadena para que solo sea email
            sanitizeArrayStrings([$_POST['password']]);
        }
        
        //set fields values into a variable
        $fields = [
            "email" => $_POST['email'],
            "password" => $_POST['password'],
        ];
        
        //set default language and theme but if are created we take the value from cookies
        $lang = 'es';
        $theme = 'light';

        
        if (isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
        if (isset($_COOKIE['theme'])) $theme = $_COOKIE['theme'];

        
        //verify if the email exists in the users table
        if ($db->verifyField('email', $fields['email'], 'users', 'email', '=')) {
            //get password from table
            $passwordDb = $db->getResponse(
                $db->select('users', ['password' => 'users']) . 
                $db->condition('email', 'users', '='), 

                [':email' => $fields['email']]
            )[0]['password'];
            //verify password with the input password or if we checked the remember checkbox it will check it with the password from the cookie directly.
            if (password_verify($fields["password"], $passwordDb) || $passwordDb == $fields['password']) {
                
                //get user id
                $userId = $db->getResponse(
                    $db->select('users', ['user_id' => 'users']) . 
                    $db->condition('email', 'users', '='), 
                    
                    [':email' => $fields['email']]
                )[0]['user_id'] ;
                
                //verify if the user exists in the settings table
                if (!$db->verifyField('id', $userId,  'settings', 'user_id', '=')) {
                    //if user has answered to the cookies policy and it is true insert into settings table
                    if ($_COOKIE['cookies_answer'] == true) {

                        $cookieValues = [
                            'user_id' => $userId,
                            'theme' => $theme,
                            'language' => $lang,
                        ];
                        
                        $db->insert('settings', $cookieValues);
                        $_SESSION['settings_cookies'] = 1;
                    }
                } else {
                    //get user settings data from databse
                    $settingsData = $db->getResponse(
                        $db->select('settings', ['theme' => 'settings', 'language' => 'settings']) . 
                        $db->condition('user_id', 'settings', '='), 
                        
                        [':user_id' => $userId]
                    )[0];
                    
                    //set cookies with theme and laguange values
                    setcookie('theme', $settingsData["theme"], 0, '/');
                    setcookie('lang', $settingsData["language"], 0, '/');

                    $lang = $settingsData["language"];

                    $_SESSION['settings_cookies'] = 1;
                }
                
                //get user data to create a session
                $userData = $db->getResponse(
                    $db->select('users', ['nombre' => 'users', 'apellidos'  => 'users', 'email'  => 'users', 'id_role'  => 'users'], $dataTranslations[$lang]) .
                    $db->condition('email', 'users', '='), 

                    [':email' => $fields['email']]
                )[0];
                
                $_SESSION['user_data'] = $userData;
                
                $_SESSION['user_data']['user_id'] = $userId;
                
                $_SESSION['user_data']['password'] = $passwordDb;
                
                $_SESSION['lang'] = $lang;

                //get the user role
                $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
                
                //if it is a student get student data from database and create session
                if($userRole == 1){

                    $studentData =  $db->getResponse(
                        $db->select('alumnos', ['id' => 'alumnos']) . 
                        $db->condition('user_id', 'alumnos', '='), 
                        
                        [':user_id' => $_SESSION['user_data']['user_id']]
                    )[0];

                    $_SESSION['student_data'] = $studentData;
                }
                //get teacher data and create a session
                else {
                    //get teacher id
                    $teacherId = $db->getResponse(
                        $db->select('profesores', ['id' => 'profesores']) .
                        $db->condition('user_id', 'profesores', '='), 
                        
                        [':user_id' => $_SESSION['user_data']['user_id']]
                    )[0];
                    
                    //get all data from subjects table
                    $teacherData = $db->getResponse(
                        $db->select('asignaturas', ['id' => 'asignaturas', 'nombre_asignatura' => 'asignaturas']) .
                        $db->condition('id_profesor', 'asignaturas', '='), 
                        [':id_profesor' => $teacherId['id']]
                    );
                    //create sessions
                    $_SESSION['teacher_data'] = $teacherId;
                    $_SESSION['teacher_data']['subjects'] = $teacherData;
                    
                }
                //if remember checkbox is checked create a cookie with the user data session 
                if (isset($_POST['remember'])) setcookie('remember', serialize($_SESSION['user_data']), time() + 3600, '/');
                //redirect to dashboard
                header("Location:dashboard");
            } else {
                //create error
                setcookie('login_error', 'La contraseña es incorrecta', 0, '/');
                header("Location:login");
            }
        } else {
            //create error
            setcookie('login_error', 'El email no existe', 0, '/');
            header("Location:login");
        }
    }
    else {
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');
    }
    
