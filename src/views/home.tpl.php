<?php
    include_once 'partials/header.tpl.php';

    //show the popup when landing on the home if we have not answered previously.
    if(!isset($_COOKIE['cookies_answer'])) {
        include_once 'partials/modalOpen.tpl.php';
    }
    
    
?>
<body>
    <div class="container-fluid">
        <?php
            echo generateNavBar($navbarOptions);
        ?>
        <main class="main-home d-flex area">
            <h1 class="title"><?= $title; ?></h1>
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
    
    
</body>
</html>