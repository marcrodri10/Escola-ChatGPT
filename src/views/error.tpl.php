<!--Error page -->
<?php
include_once 'partials/header.tpl.php';

?>
<body>
    <div class="container-fluid">
        <?php  
        echo generateNavBar($navbarOptions);
        ?>
        <main class='d-flex'>
            <h1><?php echo $_SESSION['error'] ?></h1><br>
        </main>
        <?php
        
        include_once 'partials/footer.tpl.php'
        ?>
    </div>
    
</body>
</html>