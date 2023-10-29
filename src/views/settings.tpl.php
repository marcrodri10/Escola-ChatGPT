<?php
include_once 'partials/header.tpl.php';

//establish default language and check for the theme value

$checked = null;
$lang = 'es';

//if the theme value is dark establish the value for $checked
if (isset($_COOKIE['theme'])) {
    if ($_COOKIE["theme"] == 'dark') {
        $checked = 'checked';
    }
}
//get language value if the cookie is set
if(isset($_COOKIE['lang'])){
    $lang = $_COOKIE['lang'];
}
?>
<!-- Page for settings (language and theme)-->
<body>
    
   <div class="container-fluid">
        <?php
        
            echo generateNavBar($navbarOptions);
        ?>
        <main class="d-flex">
            <form action="settingsController" method="POST" id="form-settings">
                <div class="select-div d-flex">
                    <h4>Language:</h4>
                    <div class="select-lang">
                        <select name="lang" id="select" class="form-select">
                            <?php
                            //create the language select 
                            $languages = [
                                'es' => 'Español',
                                'ca' => 'Català',
                                'en' => 'English',
                                'de' => 'Deutsch',
                                'it' => 'Italiano',
                                'fr' => 'Français',
                            ];
                            
                            foreach ($languages as $codigo => $nombre) {
                                if($codigo == $lang){
                                    echo '<option selected value="' . $codigo . '">' . $nombre . '</option>';
                                }
                                else echo '<option value="' . $codigo . '">' . $nombre . '</option>';
                                
                            }
                            ?>
                        </select>
                        
                        <?php  
                            //print the language flag
                            echo '<img src="public/img/'.$lang.'_flag.png" alt="" id="flag">'
                        ?>
                    </div>        
                </div>
                <div class="theme">
                    <h4>Theme:</h4>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="dark_mode" <?php echo $checked ?>>
                        <label class="label form-check-label" for="flexSwitchCheckDefault">Dark mode</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </main>
        <?php

        include_once 'partials/footer.tpl.php'
        ?>
   
    

    <script>
        //change the flag when clicking
        const img = document.querySelector("#flag")
        const select = document.querySelector("#select");

        select.addEventListener("change", () => {
            img.src = `public/img/${select.value}_flag.png`;
        });
        console.log();
    </script>
</body>
</html>