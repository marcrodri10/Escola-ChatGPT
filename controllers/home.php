<?php
    
    require 'src/render.php';

    //check if user is logged. If it is logged it will display a different nav bar from not logged users
    if(!isset($_SESSION['user_data'])){
        $lang = 'es';
        if(isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
        //build the nav bar
        $navbarOptions = [
            'left' => [
                ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
            ],
            'right' => [
                ['text' => $navbarTranslations[$lang]['right'][3], 'url' => 'login'],
                ['text' => $navbarTranslations[$lang]['right'][4], 'url' => 'register'],
                ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
            ],
        ];
    }
    else {
        $lang = $_SESSION['lang'];
        //build the nav bar
        $navbarOptions = [
            'left' => [
                ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                ['text' => '', 'url' => ''],
                ['text' => '', 'url' => ''],
            ],
            'right' => [
                ['text' => '', 'url' => ''],
                ['text' => $navbarTranslations[$lang]['right'][1], 'url' => 'logoutController'],
                ['text' => $navbarTranslations[$lang]['right'][2], 'url' => 'settings'],
            ],
        ];
    }
    
    $navbarOptions = setNavbarOptions($navbarOptions);
    
    echo render('home', [
        'title' => 'Escola ChatGPT',
        'navbarOptions' => $navbarOptions,
    ]);

?>