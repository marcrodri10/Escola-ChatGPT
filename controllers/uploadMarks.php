<?php
    require 'src/render.php';
    require 'conexion.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        //if we pressed the upload mark button
        if(isset($_POST['studentId'])){
            //get student data
            $studentId = $_POST['studentId'];

            $lang = $_SESSION['lang'];
            $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];

            //build the nav bar
            if($userRole == 1){
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
                $navbarOptions = [
                    'left' => [
                        ['text' => $navbarTranslations[$lang]['left'][0], 'url' => 'home'],
                        ['text' => $navbarTranslations[$lang]['left'][1], 'url' => 'dashboard'],
                        ['text' => $navbarTranslations[$lang]['left'][2], 'url' => 'marks'],
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
            
            //get students that are enrolled in the current subjecr
            $studentData = [];
            foreach($_SESSION['students_enrolled'] as $student){
                if($student['id'] == $studentId) $studentData = $student;
            }

            $_SESSION['studentEnrolledData'] = $studentData;
            $currentSubject = $_SESSION['currentSubject'];
        
            echo render('uploadMarks', [
                'title' => 'uploadMarks',
                'navbarOptions' => $navbarOptions,
                'userRole' => $userRole,
                'studentData' => $studentData,
                'currentSubject' => $currentSubject
            ]);
        }
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }
    


?>