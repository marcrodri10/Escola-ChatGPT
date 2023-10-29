<?php
include_once 'partials/header.tpl.php';
?>
<!-- Page to see the teacher's subjects and the students that are enrolled if the users is a teacher
and if the users is a student the page show exams marks of the different subjects that the student is enrolled-->
<body>
    <div class="container-fluid">
    <?php echo generateNavBar($navbarOptions); ?>

    <main class="d-flex">
        <div class="marks">
            
                    <?php
                    //show the teacher's subjects
                        if($userRole != 1) {?>
                            <form class="subjects" action="studentsMarksController" method="post">
                            <?php foreach($_SESSION['teacher_data']['subjects'] as $subject){
                                echo "<button type='submit' class='btn btn-primary' name='subject' value='".$subject['id']."'>".$subject['nombre_asignatura']."</button>";
                            }?>
                            </form>
                        <?php } ?>
            

            <?php
                //if the user is a student show the exam marks
                if($userRole == 1){ 
                    $studentMarks = $_SESSION['studentMarks'];
                    if($studentMarks != null){
                    ?>
                    <table class="table">
                    <thead>
                        <th scope='col'>Subject ID</th>
                        <th scope='col'>Subject Name</th>
                        <th scope='col'>Exam</th>
                        <th scope='col'>Mark</th>
                        <th scope='col'>Teacher Name</th>
                        <th scope='col'>Teacher LastName</th>
                    </thead>    
                    <tbody>
                        <?php }
                        //show the exam marks and the data if there are marks to show
                        if($studentMarks != null){
                            foreach($studentMarks as $studentMark){
                                echo '<tr>';
                                foreach($studentMark as $value){
                                    echo "<td scope='row'>". $value."</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        else echo '<h2>There are no marks uploaded in the subjects you are enrolled into</h2>'
                        ?>

                    </tbody>
                </table>
                <?php } 
                //if the users is a teacher it will show the students that are enrolled in the subject
                else { 
                    
                    if(isset($_SESSION['students_enrolled'])){
                        
                        $students = $_SESSION['students_enrolled'];
                        if($students != null){
                        ?>
                        <table class="table">
                        <thead>
                            <th scope='col'>Student ID</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Lastname</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Marks</th>

                        </thead>    
                        <tbody>
                            <form action="uploadMarks" method='post'>
                        <?php
                        //create for each student a button to upload marks
                            foreach($students as $student){
                                echo "<tr>";
                                foreach($student as $value){
                                    echo "<td>$value</td>";
                                } 
                                echo "<td><button type='submit' class='btn btn-primary' name='studentId' value='".$student['id']."'>Upload Mark</button></td>";
                            }
                            echo "<tr>";
                        ?>
                           </form> 
                        </tbody>
                    </table>
                    <?php }
                    else echo "<h2>There are no students enrolled in your subject</h2>"; ?>
            <?php   } ?>
                    
        <?php   } ?>
        </div>
        
    </main>
    <?php


        include_once 'partials/footer.tpl.php'
    ?>
    </div>
    
</body>
</html>