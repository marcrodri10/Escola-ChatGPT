<?php
    require 'conexion.php';
    
    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        if(isset($_POST['subject'])){

            //get data from sessions and form
            $lang = $_SESSION['lang'];
            $userRole = $_SESSION['user_data'][$dataTranslations[$lang][3]];
            $teacherId = $_SESSION['teacher_data']['id'];
            $subjectId = $_POST['subject'];

            
            ///get students that are enrolled
            $students = $db->getResponse(
                $db->select('users', ['id' => 'alumnos', 'nombre' => 'users', 'apellidos' => 'users', 'email' => 'users']) .
                $db->innerJoin('users', 'alumnos',  'user_id','user_id') .
                $db->innerJoin('alumnos','matricula','id','id_alumno') .
                $db->condition('id_asignatura', 'matricula', '=')
                ,
                [':id_asignatura' => $subjectId]
            );
            
            
            //save into a session
            if($students == null) $_SESSION['students_enrolled'] = [];
            else $_SESSION['students_enrolled'] = $students;
            
            $currentSubject = [];

            //save teacher's subjects data
            foreach($_SESSION['teacher_data']['subjects'] as $subject){
                if($subject['id'] == $subjectId) $currentSubject = $subject;
            }
            
            
            $_SESSION['currentSubject'] = $currentSubject;
            
        
            header('Location:marks');
    }
    }
    else {
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');
    }
    

?>