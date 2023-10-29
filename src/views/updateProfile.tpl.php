<?php

include_once 'partials/header.tpl.php';

?>
<!-- Page to update the user profile-->
<body>
    <div class="container-fluid">
        <?php
            echo generateNavBar($navbarOptions);
        ?>
        <main class="d-flex">
            <div class="profile">
            <?php
            //if there is an error we add a div to show the error message and delete the cookie
                if(isset($_COOKIE['update_error'])){
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        ".$_COOKIE['update_error']."
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                    setcookie('update_error', '', time() -1, '/'); 
                }
                ?>
                <form action="updateProfileController" method="post">
                    <table class="table">
                        <thead>
                        <?php
                        //student user
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
                            //teacher user
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
                        //student user
                            if($userRole == 1){
                                echo "<tr>
                                <th scope='row'>". $userDataProfile['id']."</th>
                                <td><input type='text' name='name' id='name' value='". $userDataProfile['nombre']."'></td>
                                <td><input type='text' name='lastname' id='lastname' value='". $userDataProfile['apellidos']."'></td>
                                <td><input type='text' name='email' id='email' value='". $userDataProfile['email']."'></td>
                                <td><input type='date' name='birthdate' id='birthdate' value='". $userDataProfile['fecha_nacimiento']."'></td>
                                <td><input type='text' name='address' id='address' value='". $userDataProfile['direccion']."'></td>
                            </tr>";
                            }
                            //teacher user
                            else {
                                echo "<tr>
                                <th scope='row'>". $userDataProfile['id']."</th>
                                <td><input type='text' name='name' id='name' value='". $userDataProfile['nombre']."'></td>
                                <td><input type='text' name='lastname' id='lastname' value='". $userDataProfile['apellidos']."'></td>
                                <td><input type='text' name='email' id='email' value='". $userDataProfile['email']."'></td>
                                <th>". $userDataProfile['departamento']."</th>
                            </tr>";
                            }
                        ?>
                            
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
           
        </main>
        <?php


        include_once 'partials/footer.tpl.php'
        ?>
    </div>



</body>

</html>