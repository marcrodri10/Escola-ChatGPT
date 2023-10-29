
<?php
    require 'src/render.php';
    require 'src/translations.php';

    if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];
    else {
        if(isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];
        else $lang = 'es';
    }
    $navbarOptions = [
        'left' => [
            ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
        ],
        'right' => [

        ],
    ];

    $navbarOptions = setNavbarOptions($navbarOptions);

    echo render('error', [
        'title' => 'Error',
        'navbarOptions' => $navbarOptions,
    ]);
?>
