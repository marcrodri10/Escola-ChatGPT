<?php

    //function to create a nav bar.
    function generateNavBar($options){ 
        /* options to generate the nav bar. It is an associative array that has 2 arrays: Left and 
        Right and inside an array with all the anchors with the text and the url. */

        //creating the common structure of the nav bar
        $navBar = 
        '<header class="main-header" >
            <nav class="navbar navbar-light d-flex">
                <ul class="d-flex nav-list">
                    <div class="left-nav d-flex">';
        
        //go through the left options array and create all the anchors with the text and the url
        foreach ($options['left'] as &$option) {
            $navBar .=  '<li';
            if($option['current']){
                $navBar .= ' class="current"';
            }
            $navBar .= '><a href="'.$option['url'].'">'.$option['text'].'</a></li>';            
        }
        $navBar .= '</div>
        
        <div class="right-nav d-flex">';

        //go through the right options array and create all the anchors with the text and the url
        foreach($options['right'] as $option) {
            $navBar .=  '<li';
            if($option['current']){
                $navBar .= ' class="current"';
            }
            $navBar .= '><a href="'.$option['url'].'">'.$option['text'].'</a></li>';            
        }
        $navBar .= '</div>
                </ul>
            </nav>
        </header>';
        return $navBar;
    }

    //function to get the current page
    function getCurrentPage(){
        return $_SERVER['REQUEST_URI'];
    }

    //function to setting the current page in the nav bar with with the text in bold
    /*
    If the url is the same as the current page the anchor text will be bolded
    */
    function setNavbarOptions($navbarOptions){
        $currentPage = trim(getCurrentPage(), '/');
        
        foreach ($navbarOptions['left'] as &$option) {
            
            $option['current'] = ($option['url'] == $currentPage);
        }
        
        foreach ($navbarOptions['right'] as &$option) {
            
            $option['current'] = ($option['url'] == $currentPage);
        }

        return $navbarOptions;
    }

    //function to inspect the input from a form
    function sanitizeString(string $input) {
        // delete blank spaces in the front and int the back
        $cleaned = trim($input);
    
        // delete html and php tags
        $cleaned = strip_tags($cleaned);
    
        // scape from especial characters
        $cleaned = htmlspecialchars($cleaned, ENT_QUOTES, 'UTF-8');
    
        return $cleaned;
    }

    //function to inspect the an array of inputs from a form
    function sanitizeArrayStrings(array $strings){

        foreach($strings as &$string){
            $string = sanitizeString($string);
        }

    }

    //function to set and associative array into the options for the database query execution
    function parametrizeArray(array $fields){
        $new_fields = [];
        foreach ($fields as $field => $value) {
            $new_fields[':' . $field] = $value;
        }
        
        return $new_fields;
    }
    


?>