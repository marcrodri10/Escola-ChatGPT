<?php
    require 'conexion.php';
    require 'src/translations.php';

    //get theme data and language data from cookies
    if (isset($_POST["dark_mode"])) {
        $theme = 'dark';
        setcookie('theme', $theme, 0, '/');
    } else {
        $theme = 'light';
        setcookie('theme', 'light', 0, '/');
    }

    if (isset($_POST["lang"])) {
        $lang = $_POST["lang"];
        setcookie('lang', $lang, 0, '/');
    }
    
    //check if the user is logged
    if (isset($_SESSION['user_data'])) {
       
        //get email from user session
        $email = $_SESSION['user_data'][$dataTranslations[$lang][2]];
        //get id from user session
        $userId = $_SESSION['user_data']['user_id'] ;
        
        //verify if user id exists in settings table
        if ($db->verifyField('id', $userId, 'settings', 'user_id', '=')) {
            
            //get values and update database with new values
            $settingsValues = [
                'theme' => $theme,
                'language' => $lang,
            ];
            
            $db->update('settings', $settingsValues, $userId, 'user_id');
            
        }

        //get user data to update the user session
        $userData = $db->getResponse(
            $db->select('users', ['nombre' => 'users', 'apellidos' => 'users', 'email' => 'users', 'id_role' => 'users'], $dataTranslations[$lang]) . 
            $db->condition('email', 'users', '='), 
            
            [':email' => $email]
        )[0];
              
        $_SESSION['user_data'] = $userData;
        $_SESSION['user_data']['user_id'] = $userId;

        $passwordDb = $db->getResponse(
            $db->select('users', ['password' => 'users']) . 
            $db->condition('user_id', 'users', '='), 

            [':user_id' => $_SESSION['user_data']['user_id']]
        )[0]['password'];

        
        $_SESSION['user_data']['password'] = $passwordDb;
        
        $_SESSION['lang'] = $lang;
        
        //update remember cookie if is set
        if (isset($_COOKIE['remember'])) setcookie('remember', serialize($_SESSION['user_data']), time() + 3600, '/');
    }
    header('Location:settings');
