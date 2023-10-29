<?php
include_once 'partials/header.tpl.php';
?>
<!--Page to upload the marks to a student -->
<body>
    <div class="container-fluid">
        <?php echo generateNavBar($navbarOptions); ?>
        <main class="d-flex">
            <form class="uploadMark" action="uploadMarksController" method="post">
                <table class="table">
                    <thead>
                        <th scope='col'>Subject ID</th>
                        <th scope='col'>Subject Name</th>
                        <th scope='col'>Student ID</th>
                        <th scope='col'>Name</th>
                        <th scope='col'>Lastname</th>
                        <th scope='col'>Email</th>
                        <th scope='col'>Exam</th>
                        <th scope='col'>Mark</th>
                    </thead>    
                    <tbody>
                        <td scope='row'><?php echo $currentSubject['id']?></td>
                        <td><?php echo $currentSubject['nombre_asignatura']?></td>
                        <td><?php echo $studentData['id']?></td>
                        <td><?php echo $studentData['nombre']?></td>
                        <td><?php echo $studentData['apellidos']?></td>
                        <td><?php echo $studentData['email']?></td>
                        <td><input type="text" name="exam" id="exam"></td>
                        <td><input type="number" name="mark" id="mark" max="10" min="0" step="0.1"></td>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </main>
        <?php


        include_once 'partials/footer.tpl.php'
        ?>
    </div>

</body>

</html>