<?php
    require 'conexion.php';
    require 'src/render.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        $lang = $_SESSION['lang'];
        //build the nav bar
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

        $navbarOptions = setNavbarOptions($navbarOptions);

        //get all the subjects data to display it
        $subjectsData = $db->getResponse(
            $db->select('asignaturas', 
            [
                'id' => 'asignaturas',
                'nombre_asignatura' => 'asignaturas',
                'duracion' => 'asignaturas',
                'nombre' => 'users',
                'apellidos' => 'users',
                'descripcion' => 'asignaturas'
            ]) .
            $db->innerJoin(
                'asignaturas', 
                'users', 
                'id_profesor', 
                'user_id'
            )
        );
    
        //get the subjects on where the user is enrolled
        $matricula = $db->getResponse(
            $db->select(
                'matricula', 
                ['id_asignatura' => 'matricula']
            ).
            $db->condition('id_alumno', 'matricula', '='),
            ['id_alumno' => $_SESSION['student_data']['id']]
        );
        
        //set the session
        if($matricula == null) $_SESSION['matricula'] = [];
        else $_SESSION['matricula'] = $matricula;
        
        

        echo render('enrollment', [
            'title' => 'Enrollment',
            'navbarOptions' => $navbarOptions,
            'data' => $subjectsData,
        ]);
    }
    else{
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');       
    }
?>