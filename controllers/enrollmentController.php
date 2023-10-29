<?php
    require 'conexion.php';

    //check if the user want to enroll or unroll
    if(isset($_SESSION['user_data'])){
        if(isset($_POST['alta_asignatura'])){
            
            $idAsignatura =  $_POST['alta_asignatura'];
            
            //set data to insert into enrollment table
            $matriculaData = [
                'id_alumno' => $_SESSION['student_data']['id'],
                'curso' => '2023-2024',
                'precio' => 300,
                'fecha' => date('Y-m-d'),
                'id_asignatura' => $idAsignatura,
            ];

            
            $db->insert('matricula', $matriculaData);

            
            
        }
        if(isset($_POST['baja_asignatura'])){
            //if it is unroll it will delete from enrollment table
            $idAsignatura =  $_POST['baja_asignatura'];

            $db->delete('matricula', 'id_asignatura', $idAsignatura);
        }
        header('Location:enrollment');
    }
    else {
        setcookie('login_error', 'Debes iniciar sesión', 0, '/');
        header('Location:login');
    }

    

?>