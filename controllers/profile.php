<?php
    require 'conexion.php';
    require 'src/render.php';

    if(isset($_SESSION['user_data'])){
        $lang = $_SESSION['lang'];

        $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
        $userId = $_SESSION['user_data']['user_id'];

        if($userRole == 1){

            $userDataProfile = $db->getResponse(
                $db->select('users', [
                    'id' => 'alumnos', 'nombre' => 'users', 'apellidos' => 'users',
                    'email' => 'users', 'fecha_nacimiento' => 'alumnos', 'direccion' => 'alumnos',
                ]) .
                $db->innerJoin('users', 'alumnos', 'user_id', 'user_id').
                $db->condition('user_id', 'users', '='),

                [':user_id' => $userId]
            )[0];

        
            $navbarOptions = [
                'left' => [
                    ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                    ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                    ['text' => $navbarTranslations[$lang]['left'][2], 'url' => 'enrollment'],
                    ['text' => $navbarTranslations[$lang]['left'][3], 'url' => 'marks'],
                ],
                'right' => [
                    ['text' => $navbarTranslations[$lang]['right'][0], 'url' => 'profile'],
                    ['text' => $navbarTranslations[$lang]['right'][1], 'url' => 'logoutController'],
                    ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
                ],
            ];
        
        }
        else {

            $userDataProfile = $db->getResponse(
                $db->select('users', [
                    'id' => 'profesores', 'nombre' => 'users', 'apellidos' => 'users',
                    'email' => 'users', 'departamento' => 'profesores'
                ]) .
                $db->innerJoin('users', 'profesores', 'user_id', 'user_id').
                $db->condition('user_id', 'users', '='),

                [':user_id' => $userId]
            )[0];
            
            $navbarOptions = [
                'left' => [
                    ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                    ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                    ['text' => '', 'url' => ''],
                    ['text' => '', 'url' => ''],
                ],
                'right' => [
                    ['text' => $navbarTranslations[$lang]['right'][0], 'url' => 'profile'],
                    ['text' => $navbarTranslations[$lang]['right'][1], 'url' => 'logoutController'],
                    ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
                ],
            ];
        
            }

        $navbarOptions = setNavbarOptions($navbarOptions);

        
        echo render('profile', [
            'title' => 'Profile',
            'navbarOptions' => $navbarOptions,
            'userDataProfile' => $userDataProfile,
            'userRole' => $userRole,
        ]);
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }

?>