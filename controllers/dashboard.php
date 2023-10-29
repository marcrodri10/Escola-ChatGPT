<?php

    require 'src/render.php';
    require 'src/translations.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        //get session data
        $lang = $_SESSION['lang'];

        $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
        
        if($userRole == 1){
            //build students nav bar
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
            //build teacher nav bar
            $navbarOptions = [
                'left' => [
                    ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                    ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                    ['text' => $teacherTranslations[$lang], 'url' => 'marks'],
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
        
        echo render('dashboard', [
            'title' => '¡'.$welcomTranslation[$lang].'!',
            'navbarOptions' => $navbarOptions,
            'lang' => $lang,
        ]);
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }
