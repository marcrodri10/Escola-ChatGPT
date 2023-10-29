<?php
    
    require 'conexion.php';
    
    //check if the inputs are not empty
    if (isset($_POST['name']) && $_POST['email'] && $_POST['lastname'] && $_POST['password']) {
        
        //sanitize the values
        filter_input(INPUT_POST, $_POST['email'], FILTER_SANITIZE_EMAIL); //limpia la cadena para que solo sea email
        sanitizeArrayStrings([$_POST['name'], $_POST['lastname'], $_POST['password']]);
        
        try {
            //set values 
            $userValues = [
                'nombre' => $_POST['name'],
                'apellidos' => $_POST['lastname'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'id_role' => 1,
            ];
            //check if the email exists in the database
            if (!$db->verifyField('email', $userValues['email'], 'users', 'email', '=')) {
                //insert into users table
                $db->insert('users', $userValues);

                //get user id to insert into students table
                $userId = $db->getResponse(
                    $db->select('users', ['user_id' => 'users']) . 
                    $db->condition('email', 'users', '='), 

                    [':email' => $_POST['email']]
                )[0]['user_id'] ;
                
                $alumnoValues = [
                    'user_id' => $userId,
                    'fecha_nacimiento' => null,
                    'direccion' => null,
                ];
                
                $db->insert('alumnos', $alumnoValues);
                
                header("Location:login");
            } else {
                setcookie('register_error', 'Ese email ya está en uso', 0, '/');
                header("Location:register");
            }
        } catch (PDOException $e) { 
            setcookie('register_error', 'Ha ocurrido un error inesperado. Vuelve a intentarlo más tarde', 0, '/');
            header("Location:register");
        }
    }
    else {
        header('Location:register');
    }
?>
