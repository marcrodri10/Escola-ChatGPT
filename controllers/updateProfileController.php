<?php
    
    require 'conexion.php';
    require 'src/translations.php';

    //check if user is logged in
    if(isset($_SESSION['user_data'])){
        //get new values from input parameters
        if(($_POST['name']) && $_POST['email'] && $_POST['lastname']){

            //set sessions values in variables
            $lang = $_SESSION['lang'];

            $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
            
            //get user's id and email from users table
            $dataToVerify = $db->getResponse(
                $db->select('users', ['user_id' => 'users', 'email' => 'users']) .
                $db->condition('email', 'users', '='),

                [':email' => $_POST['email']]
            );
           
            if($dataToVerify == null) $dataToVerify = [];
            
            //check if there is no user with the given email or it is the same user that is changing the data
            if(sizeof($dataToVerify) == 0 || ($dataToVerify[0]['user_id'] == $_SESSION['user_data']['user_id'])){
                
                //set values
                $profileValues = [
                    'nombre' => $_POST['name'],
                    'apellidos' => $_POST['lastname'],
                    'email' => $_POST['email'],
                ];

                //get user id
                $userId = $_SESSION['user_data']['user_id'];

                //update table users with new values
                $db->update('users', $profileValues, $userId, 'user_id');
                
                //if user is student check birthdate and address
                if($userRole == 1){
                    $birthDate = null;
                    if($_POST['birthdate'] != null){
                        $birthDate = $_POST['birthdate'];
                    }
            
                    $address = $_POST['address'];

                    //set values
                    $profileValues = [
                        'user_id' => $userId,
                        'fecha_nacimiento' => $birthDate,
                        'direccion' => $address,
                    ];
                    
                    $studentId = $_SESSION['student_data']['id'];

                    //update students table
                    $db->update('alumnos', $profileValues, $studentId, 'id');
                }
                
                //get user data and password to set the new session
                $userData = $db->getResponse(
                    $db->select('users', ['nombre' => 'users', 'apellidos' => 'users', 'email' => 'users', 'id_role'  => 'users'], $dataTranslations[$lang]) . 
                    $db->condition('email', 'users', '='), [':email' => $_POST['email']]
                )[0];
                
                $passwordDb = $db->getResponse(
                    $db->select('users', ['password' => 'users']) . 
                    $db->condition('user_id', 'users', '='), 

                    [':user_id' => $_SESSION['user_data']['user_id']]
                )[0]['password'];
                
                $_SESSION['user_data'] = $userData;
                $_SESSION['user_data']['user_id'] = $userId;
                $_SESSION['user_data']['password'] = $passwordDb;

                //if remember cookie is set: update cookie
                if (isset($_COOKIE['remember'])) setcookie('remember', serialize($_SESSION['user_data']), time() + 3600, '/');

                //redirect to profile
                header('Location:profile');
            } 
            else {
                setcookie('update_error', 'Ese email ya está en uso', 0, '/');
                header("Location:updateProfile");
            }
                
        }
    }
    else {
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');
    }
        

?>