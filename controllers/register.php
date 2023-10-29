<?php
    
    require 'src/render.php';
    $lang = 'es';
    if(isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
    //build nav bar
    $navbarOptions = [
        'left' => [
            ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
        ],
        'right' => [
            ['text' => '', 'url' => ''],
            ['text' => '', 'url' => ''],
            ['text' => $navbarTranslations[$lang]['right'][3], 'url' => 'login'],
           
        ],
    ];

    $navbarOptions = setNavbarOptions($navbarOptions);
    echo render('register', [
        'title' => 'Register-render',
        'navbarOptions' => $navbarOptions,
    ]);

?>