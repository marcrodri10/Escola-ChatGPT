<?php
    include_once 'partials/header.tpl.php';
    require 'src/translations.php';
?>
<!--Dashboard page -->
<body>

    <div class="container-fluid">
        <?php

        echo generateNavBar($navbarOptions);
        ?>
        <main class='d-flex'>
            <div class="user-data">
                <div class="title">
                    <h1 class="title" id="dash-title"><?= $title; ?></h1>
                </div>
                
                <div class="data d-flex">
                <?php
                /*print user data (name, lastname, email and role) depending on if the user is a teacher or a student and 
                if user is logged. */
                    
                    foreach($_SESSION['user_data'] as $data=>$value){
                        if($data != 'password' && $data != 'user_id'){
                            if($data == $dataTranslations[$lang][3]){
                                if($value == 1) {
                                    $value = ucfirst($userRoleTranslations[$lang][0]);
                                }
                                else $value = ucfirst($userRoleTranslations[$lang][1]);
                                   
                            } 
                            echo '<div class="d-flex gap-1"><strong>'.ucfirst($data) .':</strong>' .' <p> ' . $value."</p></div>";
                        }
                            
                    }
                    ?>
                </div>
            </div>
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
            
        </main>
        <?php
        include_once 'partials/footer.tpl.php'
        ?>
    </div>
    
  
    <!-- <a href="?url=home">HOME</a>
    <a href="?url=logoutController">LOGOUT</a>
    <a href="?url=settings">SETTINGS</a>
    <a href="?url=profile">PROFILE</a> -->
   
</body>
</html>