<?php
    require 'conexion.php';

    //check if the user has answered to the cookies policy popup
    if(isset($_POST['cookies'])){ 
        if($_POST['cookies'] == 'true') {
            $cookieAccept = true;
            setcookie('cookies_answer', $cookieAccept, 0, '/');
        }
        else {
            $cookieAccept = 0;
            setcookie('cookies_answer', $cookieAccept, 0, '/');
        }
        
    }
    
    //check if user is logged in
    if(isset($_SESSION['user_data'])){

        //get session data
        $userId = $_SESSION['user_data']['user_id'];

        $lang = $_SESSION['lang'];
        if(isset($_COOKIE['theme'])) $theme = $_COOKIE['theme'];
        else $theme = 'light';
       
        //verify if users exists in settings table
        if($db->verifyField('user_id', $userId, 'settings', 'id', '=') == null){
            //if users has accepted the cookies policy insert into the settings table
            if($cookieAccept){

                $settingsValues = [
                    'user_id' => $userId,
                    'theme' => $theme,
                    'language' => $lang,
                ];
                
                $db->insert('settings', $settingsValues);
                $_SESSION['settings_cookies'] = 1;
            }
            else {
                $db->delete('settings', 'user_id', $userId);
                $_SESSION['settings_cookies'] = 0;
            }
        }
        header('Location:dashboard');
    }
    else {
        //return to the page we were
        $referer = $_SERVER['HTTP_REFERER'];
        $url = basename(parse_url($referer, PHP_URL_PATH));
        header('Location:'.$url);
    }
    
    
    


?>