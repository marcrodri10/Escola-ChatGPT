<footer class="d-flex align-items-center">
    <ul class="d-flex justify-content-between w-25">
        <li>Instagram</li>
        <li>Youtube</li>
        <?php
        if(isset($_SESSION['user_data'])){
            include_once 'modal.tpl.php';
        }
        else echo "<li></li>";
        ?>
    </ul> 
</footer>