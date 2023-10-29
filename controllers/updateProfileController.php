<?php
    
    require 'conexion.php';
    require 'src/translations.php';
    if(isset($_SESSION['user_data'])){
        if(($_POST['name']) && $_POST['email'] && $_POST['lastname']){

            $lang = $_SESSION['lang'];

            $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
            
            $dataToVerify = $db->getResponse(
                $db->select('users', ['user_id' => 'users', 'email' => 'users']) .
                $db->condition('email', 'users', '='),

                [':email' => $_POST['email']]
            );
           
            var_dump($dataToVerify);
            if($dataToVerify == null) $dataToVerify = [];
            
            if(sizeof($dataToVerify) == 0 || ($dataToVerify[0]['user_id'] == $_SESSION['user_data']['user_id'])){
                
                $profileValues = [
                    'nombre' => $_POST['name'],
                    'apellidos' => $_POST['lastname'],
                    'email' => $_POST['email'],
                ];

                $userId = $_SESSION['user_data']['user_id'];

                $db->update('users', $profileValues, $userId, 'user_id');
                
                if($userRole == 1){
                    $birthDate = null;
                    if($_POST['birthdate'] != null){
                        $birthDate = $_POST['birthdate'];
                    }
            
                    $address = $_POST['address'];

                    $profileValues = [
                        'user_id' => $userId,
                        'fecha_nacimiento' => $birthDate,
                        'direccion' => $address,
                    ];
                    
                    $studentId = $_SESSION['student_data']['id'];
                    
                    $db->update('alumnos', $profileValues, $studentId, 'id');
                }
                
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

                if (isset($_COOKIE['remember'])) setcookie('remember', serialize($_SESSION['user_data']), time() + 3600, '/');


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