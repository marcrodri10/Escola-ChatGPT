<?php
    
    require 'conexion.php';

    //check if the user is logged
    if(isset($_SESSION['user_data'])){
        if(isset($_POST['mark']) && isset($_POST['exam'])){
            
            //get sessions data
            $studentData = $_SESSION['studentEnrolledData']; //students enrolled
            $subjectData = $_SESSION['currentSubject']; //teacher subjects

            //insert into marks table 
            $marksFields = [
                'nombre_examen' => $_POST['exam'],
                'id_alumno' => $studentData['id'],
                'id_asignatura' => $subjectData['id'],
                'nota' => $_POST['mark'],
                'id_profesor' => $_SESSION['teacher_data']['id'],
            ];

            $db->insert('calificaciones', $marksFields);
            header('Location:marks');
        }
    }
    else {
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');
    }

?>