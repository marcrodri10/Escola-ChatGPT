<?php
    
    require 'src/render.php';

    //get language value from session or cookie if not set default value to 'es'
    if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];
    else {
        if(isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
        else $lang = 'es';
    }
    
    //build nav var depending on if is set the user session or not
    if(!isset($_SESSION['user_data'])){
        //build nav bar
        $navbarOptions = [
            'left' => [
                ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
            ],
            'right' => [
                ['text' => '', 'url' => ''],
                ['text' => '', 'url' => ''],
                ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
            ],
            
        ];
    }
    else {
        $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
        //build nav bar depending if the user is a teacher or a student
        if($userRole == 1){
            $navbarOptions = [
                'left' => [
                    ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                    ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                    ['text' => '', 'url' => ''],
                    ['text' => '', 'url' => ''],
                ],
                'right' => [
                    ['text' => '', 'url' => ''],
                    ['text' => '', 'url' => ''],
                    ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
                   
                ],
                
            ];
        }
        else {
            $navbarOptions = [
                'left' => [
                    ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                    ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                    ['text' => '', 'url' => ''],
                    ['text' => '', 'url' => ''],
                ],
                'right' => [
                    ['text' => '', 'url' => ''],
                    ['text' => '', 'url' => ''],
                    ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
                   
                ],
                
            ];
        }
        
    }
   
    $navbarOptions = setNavbarOptions($navbarOptions);
    
    echo render('settings', [
        'title' => 'Settings-render',
        'navbarOptions' => $navbarOptions,
    ]);

?>