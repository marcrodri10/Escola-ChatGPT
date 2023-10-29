<?php
    require 'src/render.php';
    require 'conexion.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        
        //get session data
        $lang = $_SESSION['lang'];
        $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
        
        if($userRole == 1){
            //get student id from session
            $studentId =  $_SESSION['student_data']['id'];
            //build nav bar
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

            //get student marks to display into the page

            //get user enrollment data
            $studentEnrollmentData = $db->getResponse(
                $db->select('matricula', ['id_asignatura' => 'matricula']) .
                $db->condition('id_alumno', 'matricula', '='),

                [':id_alumno' => $studentId]
            );

            //get student marks data
            $studentMarks = $db->getResponse(
                $db->select('calificaciones',['id' => 'asignaturas', 'nombre_asignatura' => 'asignaturas', 'nombre_examen' => 'calificaciones', 
                'nota' => 'calificaciones', 'nombre' => 'users', 'apellidos' => 'users']) .
                $db->innerJoin('calificaciones', 'profesores', 'id_profesor', 'id') .
                $db->innerJoin('profesores', 'users','user_id', 'user_id') .
                $db->innerJoin('calificaciones', 'asignaturas', 'id_asignatura', 'id') . 
                $db->condition('id_alumno', 'calificaciones', '='),

                [':id_alumno' => $studentId]
            );
            
            //save into a session
            //check if user is enrolled into the subject and save into an array
            $studentMarksArray =[];
            foreach($studentEnrollmentData as $data){
                if($studentMarks != null){
                    foreach($studentMarks as $marks){
                        if($marks['id'] == $data['id_asignatura']){
                            $studentMarksArray[] = $marks;
                        }
                    }
                }
            }
            $_SESSION['studentMarks'] = $studentMarksArray;
            
        }
        else {
            //build nav bar
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
        
        
        echo render('marks', [
            'title' => 'Marks',
            'navbarOptions' => $navbarOptions,
            'userRole' => $userRole,
        ]);
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }

?>