<?php
include_once 'partials/header.tpl.php';

?>

<body>
    <div class="container-fluid">
        <?php
            echo generateNavBar($navbarOptions);
        ?>
        <main class="d-flex">
            <form id="matricula" action="enrollmentController" method="post">
            <?php
                //print all the subjects and the teacher that are on the database
                foreach($data as $subject){
                    $found = false;
                    echo '
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">'.$subject['nombre_asignatura'].'</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">'.$subject['nombre'].' '.$subject['apellidos'].'</h6>
                            <p class="card-text">'.$subject['descripcion'].'</p>
                            <h6 class="card-info mb-2 text-body-secondary">'.$subject['duracion'].' h</h6>';
                            
                            //verify if the student is enrolled or not
                            foreach($_SESSION['matricula'] as $matricula){
                                if($matricula['id_asignatura'] == $subject['id']){
                                    $found = true;
                                }
                            }
                            
                            if($found){
                                echo '<button type="submit" class="btn btn-primary btn-card" name="baja_asignatura" value='.$subject['id'].'>Unroll</button>';
                            }
                            else echo '<button type="submit" class="btn btn-primary btn-card" name="alta_asignatura" value='.$subject['id'].'>Enroll</button>';
                           
                        echo '</div>
                  </div>';
                }
            ?>
            </form>
            
        </main>
        <?php


        include_once 'partials/footer.tpl.php'
        ?>
    </div>
</body>