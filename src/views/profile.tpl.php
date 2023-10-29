<?php
include_once 'partials/header.tpl.php';

?>
<!-- Page to see the user profile data-->
<body>
    <div class="container-fluid">
        <?php
            echo generateNavBar($navbarOptions);
        ?>
        <main class="d-flex">
            <div class="profile">
                <table class="table">
                    <thead>
                        <?php
                        //students profile
                        if($userRole == 1){
                            echo "<tr>
                            <th scope='col'>Student ID</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Lastname</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Birthdate</th>
                            <th scope='col'>Address</th>
                        </tr>";
                        }
                        //teacher profile
                        else {
                            echo "<tr>
                            <th scope='col'>Teacher ID</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Lastname</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Department</th>
                        </tr>";
                        }

                        ?>
                        
                    </thead>
                    <tbody>
                        <?php 
                        //student profile values
                        if($userRole == 1){
                            echo " <tr>
                            <th scope='row'>". $userDataProfile['id']."</th>
                            <td>". $userDataProfile['nombre']."</td>
                            <td>". $userDataProfile['apellidos']."</td>
                            <td>". $userDataProfile['email']."</td>
                            <td>". $userDataProfile['fecha_nacimiento']."</td>
                            <td>". $userDataProfile['direccion']."</td>
                        </tr>";
                        }
                        else {
                            //teacher profile values
                            echo " <tr>
                            <th scope='row'>". $userDataProfile['id']."</th>
                            <td>". $userDataProfile['nombre']."</td>
                            <td>". $userDataProfile['apellidos']."</td>
                            <td>". $userDataProfile['email']."</td>
                            <td>". $userDataProfile['departamento']."</td>
                        </tr>";
                        }
                        ?>
                       
                    </tbody>
                </table>
            <a id="updateProfileBtn" href="updateProfile" class='text-light'>Update</a>
            </div>
           
        </main>
        <?php


        include_once 'partials/footer.tpl.php'
        ?>
    </div>



</body>

</html>