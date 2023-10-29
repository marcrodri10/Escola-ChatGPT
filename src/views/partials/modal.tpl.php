<?php 
require 'src/translations.php'; 
$lang = 'es';
if(isset($_COOKIE['lang'])) $lang = $_COOKIE['lang'];

?>

<a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><?php echo$footerTranslations[$lang][0] ?></a>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo$footerTranslations[$lang][0] ?></h1>
                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body">
            <?php echo $footerTranslations[$lang][1] ?>
            </div>
            <form action="cookiesPolicyController" method="POST">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" name="cookies" value="true">
                        <?php echo $buttonsTranslations[$lang][0]  ?>
                    </button>
                    <?php   
                    if(isset($_SESSION['settings_cookies'])  && $_SESSION['settings_cookies'] == 1){
                        echo ' <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="cookies" value="false">'.$buttonsTranslations[$lang][1].'</button>';
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
